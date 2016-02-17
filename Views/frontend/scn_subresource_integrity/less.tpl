{block name="frontend_scn_subresource_integrity_less"}
    {{compileLess timestamp={themeTimestamp} output="lessFiles"}}
    {foreach $lessFiles as $stylesheet}
        <link href="{$stylesheet}" media="all" rel="stylesheet" type="text/css" integrity="{sri file=$stylesheet}" />
    {/foreach}

    {if $theme.additionalCssData}
        {$theme.additionalCssData}
    {/if}
{/block}
