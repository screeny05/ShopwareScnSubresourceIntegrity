{extends file="parent:frontend/index/header.tpl"}

{block name="frontend_index_header_css_screen"}
    {if {config namespace=ScnSubresourceIntegrity name=enableCss}}
        {include file="frontend/scn_subresource_integrity/less.tpl"}
    {/if}
{/block}
