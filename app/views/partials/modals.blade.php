<div class="modal hide fade" id="ddmenuItemModal" tabindex="-1" role="dialog" aria-labelledby="ddmyModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="ddmyModalLabel">DD Menu Item</h4>
			</div>
			<div class="modal-body" id="ddmodalbody">
			
				<form id="ddmenuItemForm" class="form-horizontal" name="ddmenuItemForm" method="post" action="/menu/saveddmenuitem">
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
									@foreach(Page::all() as $item)
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
						<label for="menu_page_id" class="control-label">Links to</label>
						<div class="controls">
							<div class="input-prepend"> 
								<span class="add-on"><i class="icon-link"></i></span>
								<select name="menu_page_id" id="menu_page_id">
									<option value="0">Does not link to page</option>
									@foreach(Page::all() as $item)
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