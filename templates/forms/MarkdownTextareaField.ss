<div class="toolbar">
    <% loop $ToolbarButtons %>
        <button data-prefix="$prefix" data-affix="$affix" title="$name"
            <% if $preview %> data-preview="true" <% end_if %>>
            <% if $pic %>
                <img src="markdowntextareafield/templates/images/buttons/$pic" alt="$name" title="$name">
            <% else %>
                $label
            <% end_if %>
        </button>
    <% end_loop %>
</div>
<textarea data-parseurl="{$Link}/parse" $AttributesHTML>$Value</textarea>
<iframe class="previewarea" src="{$Link}/preview" frameborder="0" scrolling="auto"></iframe>
