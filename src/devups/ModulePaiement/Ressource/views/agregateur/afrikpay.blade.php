@extends('layout')
@section('title', 'List')

@section('layout_content')
    <?php
    use devups\ModulePaiement\Controller\AfrikpayController;use devups\ModulePaiement\Controller\MonetbilController;
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-5 " style="border: 1px solid #c8eedb;height: 295px">
                <img src="img/afrikpay.png" style="width: 90%;padding-top:20%">
            </div>
            <div class="col-md-7">
                <form class="form-group" method="POST" action="" style="border: 1px solid #9de0f6;padding: 20px;height: 295px">
                    <div class="input-group mb-2" style="padding-top: 16%">
                        <input type="text" style="height: 50px;" class="marchandid form-control" id="inlineFormInputGroup" name="marchandid"  required   placeholder="merchant id">
                        <div class="input-group-prepend">
                            <button class="send btn btn-primary" style="font-size:15px ">Valider</button>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['marchandid'])){
                        $a=AfrikpayController::url();
                    if ($a['resultat']=="UNKNOWN_MERCHANT"){
                    ?><div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong class="fa fa-exclamation"></strong>&ensp;&ensp; Verifier votre marchand Id.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div><?php
                    }
                    else{
                    ?><div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong class="fa fa-check"></strong>&ensp;&ensp; Votre marchand Id a été enregistré avec success.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php                    }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
    <script>
  if(window.addEventListener){
    window.addEventListener('load', maFonctionDeTest, false);
}else{
    window.attachEvent('onload', maFonctionDeTest);
}

function maFonctionDeTest()
{

    $('.send').click(function(){
    $.ajax
        ({
              url : __env+'api/add.reference',
              type : 'POST',
              data :{
                reference: $('.marchandid').val(),
                agregateur: "<?php echo Request::get('name');?>"
                },
              dataType : 'text',
              success : function(code, statut){
                console.log(code);
              }
        });


    })


}
</script>
@endsection