{if $rewrite.vars[0] eq 'error' OR  $rewrite.vars[0] eq 'success'}
    <div class="col-md-12">
        <div class="callout callout-{$rewrite.vars[0]}">
            {if $rewrite.vars[0] eq 'error'}
                <b>Błąd.</b> Spróbuj jeszcze raz!
            {else}
                <b>Sukces.</b> Dane zostały zmienione.
            {/if}
        </div>
    </div>
{/if}


