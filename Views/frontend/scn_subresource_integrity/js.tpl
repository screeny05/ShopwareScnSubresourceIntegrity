{block name="frontend_scn_subresource_integrity_js"}
    {compileJavascript timestamp={themeTimestamp} output="javascriptFiles"}
    {foreach $javascriptFiles as $file}
        <script src="{$file}"
            {if {config namespace=ScnSubresourceIntegrity name=enableJs}}integrity="{sri file=$file}"{/if}
            {if {config namespace=ScnSubresourceIntegrity name=activateCrossoriginAnonymous}}crossorign="anonymous"{/if}></script>
    {/foreach}
{/block}
