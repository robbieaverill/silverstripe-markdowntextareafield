<div class="toolbar">
	<% loop $ToolbarButtons %>
		<button data-prefix="$prefix" data-affix="$affix">
			<% if $pic %>
				<img src="markdowntextareafield/templates/images/buttons/$pic" alt="$name" title="$name">
			<% else %>
				$label
			<% end_if %>
		</button>
	<% end_loop %>
</div>
<textarea $AttributesHTML>$Value</textarea>
<div class="previewarea">
	<iframe src="{$Link}/preview" frameborder="0" scrolling="auto"></iframe>
</div>