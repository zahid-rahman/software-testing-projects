	<?php /*print_r($mPreparedContent);*/
 
	 echo '<div class="panel panel-primary">
                            <div class="panel-heading"><strong> Posted By </strong> :: '.($mPreparedContent['username']).' &nbsp; <span class="pull-right"><strong> Post Date</strong> :: '.($mPreparedContent['lne_date']).'</span></div>
                            <div class="panel-body">

                            <div class="row">
		<div class="col-lg-12"> 

		</div>
	</div>
	<span><strong> '.myTruncate($mPreparedContent['lne_subject'],35).' </strong></span>
	<hr/>

	<div class="row">
		<div class="col-lg-12"> '.($mPreparedContent['lne_content']).'

		</div>
	</div>


	<div class="row">
		<div class="col-lg-12"> 

		</div>
	</div>

	</div>
	</div>';

   