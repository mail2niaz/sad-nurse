<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'operator/operatorlist','<i class="icon-backward"></i>&nbsp;&nbsp;'.( sprintf( lang("LEFTMENU::operator-list")) ).'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("OPERATOR::view_operator")) ); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span9">
                <h4 class="widgettitle"><?php echo ( sprintf( lang("OPERATOR::view_operator")) ); ?></h4>
                <div class="widgetcontent nopadding">
          <div class="stdform stdform2">
          					<p>
                                <label><?php echo ( sprintf( lang("OPERATOR::suspended")) ); ?><span class="rstar">*</span></label>
                                <span class="field">
                                	<?php echo ucwords($optval->suspended); ?></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::fname")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->firstname;?></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::lname")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->lastname;?></span>
                            </p>

							<p>
                                <label><?php echo ( sprintf( lang("COMMON::birthday")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo date("d-m-Y", strtotime($optval->dob));?></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::email")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->email;?></span>
                            </p>
							<p>
                                <label><?php echo ( sprintf( lang("OPERATOR::uname")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->username;?></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::role")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $this->common->getrolename($optval->role); ?></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::district_opt")) ); ?><span class="rstar">*</span></label>
                                <span class="field">
                                	 <?php
                                $dist_id = explode(",", $optval->dist_id);
								foreach($dist_id as $dist){
									echo $this->common->getdistname($dist)."<br>";
								}
								//echo $dist_name = implode(", ", $dists);
                                ?>
                                	<?php //echo $this->common->getdistname($optval->dist_id); ?></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::starting_point_address")) ); ?></label>
                                <span class="field"><?php echo $optval->starting_point_address; ?></span>
                            </p>
							<p>
                                <label><?php echo ( sprintf( lang("OPERATOR::tag")) ); ?></label>
                                <span class="field">
                                <?php
                                $tags = explode(",", $optval->tags);
								foreach($tags as $tags_id){
									$tag[] = $this->common->get_tag_names($tags_id);
								}
								echo $tag_name = implode(", ", $tag);
                                ?>
                                </span>
                            </p>
							<p>
                                <label><?php echo ( sprintf( lang("OPERATOR::qualification")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->qualification;?></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::hours_contract")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->hours_contract;?></span>
                            </p>

 							<p>
                                <label><?php echo ( sprintf( lang("OPERATOR::con_no")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->contact_no;?></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::land_no")) ); ?></label>
                                <span class="field"><?php echo $optval->landline_no;?></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::street")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->street;?></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::hb_no")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->hb_no;?></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::city")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->city;?></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::postal_code")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->postalcode;?></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::pro_code")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->provincecode;?></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::mob_udid")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->mobile_udid;?></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::note")) ); ?></label>
                                <span class="field"><?php echo $optval->note;?></span>
                            </p>
							<?php if($sedit == '1'){ ?>
                            <p class="stdformbutton" style="text-align:right">
                            	<?php $attributes2 = array('class' => 'btn btn-primary btn-submit');
                            	echo anchor($i18n.'operator/editoperator/'.$optval->oid,'<i class="icon-link"></i>&nbsp;&nbsp;'.( sprintf( lang("OPERATOR::edit_operator")) ),$attributes2); ?> </a>
                            </p>
                            <?php } ?>
</div>
                </div><!--widgetcontent-->
            </div><!--widget-->


            <div class="footer">
                    <div class="footer-left">
                        <span></span>
                    </div>
                    <div class="footer-right">
                        <span></span>
                    </div>
                </div><!--footer-->

            </div><!--maincontentinner-->
        </div><!--maincontent-->

    </div><!--rightpanel-->

</div><!--mainwrapper-->
<?php $this->load->view('common/footer'); ?>