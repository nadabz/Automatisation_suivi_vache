$(document).ready(function () {
    $('body').on('click', '.supprimer_element', function () {
        if (!confirm($(this).attr('msg'))) {
            return false;
        }
    })
    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        language: 'fr',
        autoclose: true
    });
    $('body').on('change', '#user_edit_roles input[type=checkbox]', function () {
        $('#user_edit_roles input[type=checkbox]').each(function () {
            $(this).prop('checked', false);
        });
        $(this).prop('checked', true);
    });
    $('body').on('change', '#pfe_suivivachebundle_reception_aliment', function () {
        var aliment = $(this).val();
        var url = $('#form_reception').attr('url');
        if (aliment != '') {
            $('.loading_reception').show();
            $.ajax({
                url: url,
                method: 'POST',
                data: 'aliment=' + aliment,
                success: function (result) {
                    $('.loading_reception').hide();
                    $(".body_reception").html(result);
                }
            });
        } else {

        }
    });
    $('body').on('click', '.affecter_vache', function () {
        $('#modalAffectation').modal('show');
        var numero = $(this).attr('num_vache');
        var url = $(this).attr('url');
        $('#titre_modal_affect').html('Affectation de la vache N°: ' + numero);
        $('.loading_affect').show();
        $.ajax({
            url: url,
            method: 'POST',
            data: 'num_vache=' + numero,
            success: function (result) {
                $('.loading_affect').hide();
                $("#body_modal_affect").html(result);
            }
        });
    });
    $('body').on('click', '.valid_affect_vache', function () {
        var id_lot = $(this).attr('id_lot');
        var id_vache = $(this).attr('id_vache');
        var url = $(this).attr('url');
        $('.loading_exec').show();
        $.ajax({
            url: url,
            method: 'POST',
            data: 'id_vache=' + id_vache + '&id_lot=' + id_lot,
            success: function (result) {
                $('.loading_exec').hide();
                var obj = JSON.parse(result);
                console.log(obj);
                $('#modalAffectation').modal('hide');
                $('#btn_affect_' + id_vache).hide();
                $('#num_lot_' + id_vache).html(obj.num_lot);
                if (obj.type_vache == 1) {
                    $('#ajax_btn_sui_poids_' + id_vache).show();
                } else if (obj.type_vache == 2) {
                    $('#ajax_btn_sui_prod_' + id_vache).show();
                }
            }
        });
    });

    $('body').on('change', '#aliment_distibuer', function () {
        $('.btn_save_distribution').show();
        $('.qte_dispo_aliment').html('');

        var id_aliment = $(this).val();
        var qte = $('.aliment_' + id_aliment).attr('qte_distribue');
        var nb_vache = $('.aliment_' + id_aliment).attr('nb_vache');
        var qte_stock = $('.aliment_' + id_aliment).attr('qte_stock');
        $('.qte_aliment').val(qte);
        if(id_aliment!=''){
            var qte_necessaire=qte*nb_vache;
            if(qte_necessaire<=qte_stock){
                $('.qte_dispo_aliment').html("<div style='color: green;margin-top: 30px;'>Stock disponible : "+qte_stock+"</div>");
            }else{
                $('.qte_dispo_aliment').html("<div style='color: red;margin-top: 30px;'>Stock Insuffisant : "+qte_stock+"</div>");
                $('.btn_save_distribution').hide();
            }
        }

    });
    $('body').on('click', '.btn_distribution', function () {
        $('#modalDistribution').modal('show');
        afficher_modal_distribution($(this));
    });

    $('body').on('click', '.btn_save_distribution ', function () {
        var id_lot = $('#id_lot').val();
        var nb_err = 0;
        if ($('#aliment_distibuer').val() == '') {
            $('#aliment_distibuer').css({'border': '1px solid red'});
            nb_err++;
        } else {
            $('#aliment_distibuer').css({'border': '1px solid #ccc'});
        }
        $('.qte_aliment').each(function(){
            if($(this).val()=='' ||!$.isNumeric($(this).val()) || $(this).val()<=0 ){
                $(this).css({'border':'1px solid red'});
                nb_err++;
            }else{
                $(this).css({'border':'1px solid #ccc'});
            }
        })

        if (nb_err == 0) {
            $('.loading_action').show();
            var post_url = $('#distribution_aliment').attr("action"); //get form action url
            var request_method = $('#distribution_aliment').attr("method"); //get form GET/POST method
            var form_data = $('#distribution_aliment').serialize();
            $.ajax({
                url: post_url,
                type: request_method,
                data: form_data,
                error: function (resultat, statut, erreur) {
                },
                success: function (data) {
                    $('.loading_action').hide();
                    afficher_modal_distribution($('#btn_dist_' + id_lot));
                }
            });

        } else {
            return false;
        }
    });
    $('body').on('click', '.btn_suivi_poids', function () {
        $('#modalSuiviPoids').modal('show');
        $('#poids_vache').val('');
        var numero = $(this).attr('num_vache');
        var id_vache = $(this).attr('id_vache');
        $('#titre_modal_suivi_poids').html('Suivi poids de la vache N°: ' + numero);
        $('#id_vache_sui_poids').val(id_vache);
    });
    $('body').on('click', '.btn_save_sui_poids', function () {
        var id_vache = $('#id_vache_sui_poids').val();
        var poids_vache = $('#poids_vache').val();
        var url = $('.btn_suivi_poids').attr('url');
        if (poids_vache == '') {
            $('.err_suivi_poids').html('Saisissez le poids');
        } else if (!$.isNumeric(poids_vache) || poids_vache <0 || poids_vache ==0 )
        {

            $('.err_suivi_poids').html('Saisissez un poids valide valide');
        } else {
            $('.loading_affect').show();

            $.ajax({
                url: url,
                method: 'POST',
                data: 'id_vache=' + id_vache + '&poids_vache=' + poids_vache,
                success: function (result) {
                    console.log(result);
                    $('.loading_affect').hide();
                    $('#modalSuiviPoids').modal('hide');
                }
            });
        }
    });
    $('body').on('click', '.btn_suivi_production', function () {
        $('#modalSuiviProduction').modal('show');
        $('#production_vache').val('');
        var numero = $(this).attr('num_vache');
        var id_vache = $(this).attr('id_vache');
        $('#titre_modal_suivi_production').html('Suivi production de la vache N°: ' + numero);
        $('#id_vache_sui_production').val(id_vache);
    });

    $('body').on('click', '.btn_save_sui_production ', function () {
        var id_vache = $('#id_vache_sui_production').val();
        var url = $('.btn_suivi_production').attr('url');
        var production_vache = $('#production_vache').val();
        if (production_vache == '') {
            $('.err_prod_lait').html('Saisissez la qte de production');
        } else if (!$.isNumeric(production_vache) || production_vache <0 || production_vache ==0 ) {

            $('.err_prod_lait').html('Saisissez une quantité valide');
        } else {
            $('.loading_affect').show();
            $.ajax({
                url: url,
                method: 'POST',
                data: 'id_vache=' + id_vache + '&production_vache=' + production_vache,
                success: function (result) {
                    console.log(result);
                    $('.loading_affect').hide();
                    $('#modalSuiviProduction').modal('hide');
                }
            });
        }
    });

});
function afficher_modal_distribution(id_btn) {

    $('.loading_action').show();
    $('.liste_distribution_jour').html('');
    $('#aliment_lot').val('');
    $('#qte_aliment').val('');

    var id_lot = id_btn.attr('id_lot');
    var num_lot = id_btn.attr('num_lot');
    var id_type_vache = id_btn.attr('id_type_vache');
    var id_race_vache = id_btn.attr('id_race_vache');
    var id_tranche_vache = id_btn.attr('id_tranche_vache');
    var url = id_btn.attr('url');

    $('#titre_modal_distribution').html("Distribution d'aliment pour le lot N°" + num_lot);

    $('#id_lot_distribution').val(id_lot);

    $.ajax({
        url: url,
        method: 'POST',
        data: 'id_lot=' + id_lot + '&id_type_vache=' + id_type_vache + '&id_race_vache=' + id_race_vache + '&id_tranche_vache=' + id_tranche_vache,
        success: function (result) {
            $('.loading_action').hide();
            $('.liste_distribution_jour').html(result);
        }
    });
}
