<div class="modal hide fade" id="ddmenuItemModal" tabindex="-1" role="dialog" aria-labelledby="ddmyModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="ddmyModalLabel">DD Menu Item</h4>
			</div>
			<div class="modal-body" id="ddmodalbody">
			
				<form id="ddmenuItemForm" class="form-horizontal" name="ddmenuItemForm" method="post" action="/menu/saveddmenuitem">
				
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#dddetails">Details</a></li>
						<li><a data-toggle="tab" href="#ddplacement">Placement</a></li>
					</ul>
					
					<div class="tab-content">
					
						<div class="tab-pane active" id="dddetails">
							<div class="control-group">
								<label for="ddmenu_text" class="control-label">Menu text</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on">A</span>
										<input type="text" name="ddmenu_text" id="ddmenu_text" class="required" autofocus>
									</div>
								</div>
						    </div>
						    
						    <div class="control-group">
								<label for="ddmenu_active" class="control-label">Active?</label>
								<div class="controls">
									<div class="input-prepend"> 
										<span class="add-on"><i class="icon-check-sign"></i></span>
										<select name="ddmenu_active" id="ddmenu_active">
											<option value="1">Yes</option>
											<option value="0">No</option>
										</select>
									</div>
								</div>
						    </div>
						    
						    <div class="control-group">
								<label for="ddmenu_page_id" class="control-label">Links to</label>
								<div class="controls">
									<div class="input-prepend"> 
										<span class="add-on"><i class="icon-link"></i></span>
										<select name="ddmenu_page_id" id="ddmenu_page_id">
											<option value="0">Does not link to page</option>
											@foreach(Page::orderBy('page_title', 'ASC')->get() as $item)
											<option value="{{ $item->id }}">{{ $item->page_title }}</option>
											@endforeach
										</select>
									</div>
								</div>
						    </div>
						    
						    <div class="control-group">
								<label for="ddmenu_url" class="control-label">URL</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><i class="icon-external-link-sign"></i></span>
										<input type="text" name="ddmenu_url" id="ddmenu_url" class="" autofocus>
									</div>
								</div>
						    </div>
						    <input type="hidden" name="ddmenu_item_id" id="ddmenu_item_id" value="0">
						    <input type="hidden" name="dd_parent_menu_item_id" id="dd_parent_menu_item_id" value="0">
						   
						</div>
						
						<div class="tab-pane" id="ddplacement">
							
						</div>
					</div>
					<input type='hidden' id="nestabledd-output" name="sortorder">
				</form>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" onclick="deleteDDMenuItem()">Delete</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" onclick="$('#ddmenuItemForm').submit()">Save</button>
			</div>
		</div>
	</div>
</div>


<div class="modal hide fade" id="menuItemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Menu Item</h4>
			</div>
			<div class="modal-body" id="modalbody">
			
				<form id="menuItemForm" class="form-horizontal" name="menuItemForm" method="post" action="/menu/savemenuitem">
					
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#details">Details</a></li>
						<li id="sortmenuitems"><a data-toggle="tab" href="#placement">Placement</a></li>
					</ul>
 
					<div class="tab-content">
					
						<div class="tab-pane active" id="details">
							<div class="control-group">
								<label for="menu_text" class="control-label">Menu text</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on">A</span>
										<input type="text" name="menu_text" id="menu_text" class="required" autofocus>
									</div>
								</div>
						    </div>
						    
						    <div class="control-group">
								<label for="menu_active" class="control-label">Active?</label>
								<div class="controls">
									<div class="input-prepend"> 
										<span class="add-on"><i class="icon-check-sign"></i></span>
										<select name="menu_active" id="menu_active">
											<option value="1">Yes</option>
											<option value="0">No</option>
										</select>
									</div>
								</div>
						    </div>
						    
						    <div class="control-group">
								<label for="has_children" class="control-label">Drop down list?</label>
								<div class="controls">
									<div class="input-prepend"> 
										<span class="add-on"><i class="icon-link"></i></span>
										<select name="has_children" id="has_children">
											<option value="1">Yes</option>
											<option value="0">No</option>
										</select>
									</div>
								</div>
						    </div>
						    
						    <div class="control-group">
								<label for="menu_page_id" class="control-label">Links to</label>
								<div class="controls">
									<div class="input-prepend"> 
										<span class="add-on"><i class="icon-link"></i></span>
										<select name="menu_page_id" id="menu_page_id">
											<option value="0">Does not link to page</option>
											@foreach(Page::orderBy('page_title', 'ASC')->get() as $item)
											<option value="{{ $item->id }}">{{ $item->page_title }}</option>
											@endforeach
										</select>
									</div>
								</div>
						    </div>
						    
						    <div class="control-group">
								<label for="menu_url" class="control-label">URL</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><i class="icon-external-link-sign"></i></span>
										<input type="text" name="menu_url" id="menu_url" class="" autofocus>
									</div>
								</div>
						    </div>
						    <input type="hidden" name="menu_item_id" id="menu_item_id" value="0">
						    
						</div>
						
						<div class="tab-pane" id="placement">
							
							<div class="dd" id="nestable">
									<ol class="dd-list">
										@foreach((MenuItem::where('menu_id','=','1')->orderBy('sort_order')->get()) as $item)
										<li class="dd-item" data-id="{{ $item->id }}">
											<div class="dd-handle">{{ $item->menu_text}}</div>
										</li>
										@endforeach
									</ol>
							</div>
							<input type='hidden' id="nestable-output" name="sortorder">
						</div>
					</div>
				
				</form>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" onclick="deleteMenuItem()">Delete</button>
				&nbsp;&nbsp;
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" onclick="$('#menuItemForm').submit()">Save</button>
			</div>
		</div>
	</div>
</div>

<form method="post" action="/menu/deletemenuitem" name="deletemenuitemform" id="deletemenuitemform">
	<input type="hidden" name="deleteid" id="deleteid">
</form>

<form method="post" action="/menu/deleteddmenuitem" name="deleteddmenuitemform" id="deleteddmenuitemform">
	<input type="hidden" name="dddeleteid" id="dddeleteid">
</form>