{extends file="parent:frontend/index/index.tpl"}

{block name="frontend_index_header_javascript_jquery_lib"}
    {if true}
        {include file="frontend/scn_subresource_integrity/js.tpl"}
    {/if}
{/block}
