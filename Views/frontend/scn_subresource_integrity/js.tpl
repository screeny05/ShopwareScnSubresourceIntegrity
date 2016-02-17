{block name="frontend_scn_subresource_integrity_js"}
    {compileJavascript timestamp={themeTimestamp} output="javascriptFiles"}
    {foreach $javascriptFiles as $file}
        <script src="{$file}" integrity="{sri file=$file}"></script>
    {/foreach}
{/block}
