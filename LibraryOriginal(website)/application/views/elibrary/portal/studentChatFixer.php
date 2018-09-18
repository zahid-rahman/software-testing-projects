<?php
 

$sReturn = '<h2 class="chat-header">
						    <i class="fa fa-comment"></i> 
						    <span class="btn btn-xs btn-success" id="current_status">Online</span>

						    <a href="javascript:;" class="chat-form-close pull-right"><i class="fa fa-remove"></i></a>
						    <span class="dropdown user-dropdown">
						    <a href="javascript:;" class="pull-right chat-config" class="dropdown-toggle" data-toggle="dropdown">
						        <i class="fa fa-cog"></i>
						    </a>
						    <ul class="dropdown-menu">
						        <li class="divider"></li>
						        <li>
						            <a href="javascript: void(0);" id="edit-profile">
						              <span class="pull-left">Profile</span>
						              <span class="fa fa-user pull-right"></span>
						              <span class="clearfix"></span>
						            </a>
						        </li>
						        <li class="divider"></li>
						        <li>
						            <a href="javascript: void(0);" id="change-password">
						              <span class="pull-left">Change Password</span>
						              <span class="fa fa-lock pull-right"></span>
						              <span class="clearfix"></span>
						            </a>
						        </li>
						        <li class="divider"></li>
						        <li>
						            <a href="javascript: void(0);">
						              <div class="btn-group btn-toggle status-btn-group"> 
						                <button class="btn btn-xs btn-success">Online</button>
						                <button class="btn btn-xs btn-default">Offline</button>
						              </div>
						            </a>
						        </li>
						        <li class="divider"></li>
						        <li>
						            <a href="javascript: void(0);" id="logout">
						              <span class="pull-left">Sign Out</span>
						              <span class="fa fa-sign-out pull-right"></span>
						              <span class="clearfix"></span>
						            </a>
						        </li>
						    </ul>
						    </span>
						</h2>

						<!--
						| CHAT CONTACTS LIST SECTION
						-->
						<div class="chat-inner" id="chat-inner" style="position:relative;">
						<div class="chat-group">
						 <strong>Friends</strong>';

				foreach($aResult  as $aVal){
					$sReturn .='
									<a href="javascript: void(0)" data-toggle="popover" >
								    <div class="contact-wrap">
								      <input type="hidden" value="'.$aVal['lou_user_id'].'" name="user_id" />
								       <div class="contact-profile-img">
								           <div class="profile-img">
								                        <img src="'.$aVal['username'].'" class="img-responsive">
								           </div>
								       </div>
								        <span class="contact-name">
								            <small class="user-name">'.$aVal['username'].'</small>
								            <span class="badge progress-bar-danger" rel="'.$aVal['lou_user_id'].' "></span>
								        </span>
								        <span style="display: table-cell;vertical-align: middle;" class="user_status">
								             
								            <span class="user-status is-offline"></span>
								        </span>
								    </div>
								    </a>';
				}

				$sReturn .='</div>
								</div>
								<!--
								| CHAT CONTACT HOVER SECTION
								-->
								<div class="popover" id="popover-content">
								    <div id="contact-image"></div>
								    <div class="contact-user-info">
								        <div id="contact-user-name"></div>
								        <div id="contact-user-status" class="online-status"></div>
								    </div>
								</div>
								<!--
								| INDIVIDUAL CHAT SECTION
								-->
								<div id="chat-box" style="top: 400px">
								<div class="chat-box-header">
								    <a href="javascript: void(0);" class="chat-box-close pull-right">
								        <i class="fa fa-remove"></i>
								    </a>
								    <span class="user-status is-online"></span>
								    <span class="display-name"></span>
								    <small></small>
								</div>

								<div class="chat-container">
								    <div class="chat-content">
								        <input type="hidden" name="chat_buddy_id" id="chat_buddy_id"/>
								        <ul class="chat-box-body"></ul>
								    </div>
								    <div class="chat-textarea">
								        <input placeholder="Type your message" class="form-control" />
								    </div>
								</div>
								</div>';

								echo $sReturn;
								?>