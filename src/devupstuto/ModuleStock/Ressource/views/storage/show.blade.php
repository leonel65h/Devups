
@extends('layout')
@section('title', 'Show')


@section('content')
                
                    <div class="row">
                            <div class="col-lg-12">
                                    <ol class="breadcrumb">
                                            <li class="active">
                                                    <i class="fa fa-dashboard"></i> <?php echo CHEMINMODULE; ?>  > Detail 
                                            </li>
                                    </ol>
                            </div>
                            <div class="col-lg-12"><?= $__navigation  ?></div>
                    </div>
                    <div class="row">
                                            
                    <div class="col-lg-12 col-md-12">
                    
			<?php StorageForm::__renderDetailWidget($storage); ?>
			
	<div class="form-group text-center">
		<?php echo Genesis::actionListView("storage", $storage->getId()); ?>
	</div>
	
	</div>
					
                    </div>        
         
@endsection