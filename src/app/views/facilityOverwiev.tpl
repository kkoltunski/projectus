{extends file='main.tpl'}

{block name=content}

<h3 class="thin text-center">{$page_title}</h3>
<hr>

<form action="{$conf->action_url}processFiltering" method="post">
    {include file='searchBar.tpl'}
</form>

<div class="myContainer">
    <div class="myTable">
        <div class="myTable-header">
            <div class="header__item"><label>Imie</label></div>
            <div class="header__item"><label>Nazwisko</label></div>

            {if !\core\RoleUtils::inRole('admin')}
                <div class="header__item"><label></label></div>
            {/if}
        </div>
        <div class="myTable-content">
            {if !empty($data)}
                {foreach $data as $doctor}
                    <div class="myTable-row">
                        {foreach $doctor as $param}
                            {if strcmp($param, $doctor['name']) == 0}
                                <div class="myTable-data"><label>{$param}</label></div>
                            {elseif strcmp($param, $doctor['surname']) == 0}
                                <div class="myTable-data"><label>{$param}</label></div>
                            {/if}
                        {/foreach}

                        {if !\core\RoleUtils::inRole('admin')}
                            <div div class="myTable-data">
                                <form action="{$conf->action_url}scheduleSelected" method="post">
                                    <button class="btn btn-action" name="buttonValue" type="submit"
                                        value={$doctor['id']}>Wybierz</button>
                                </form>
                            </div>
                        {/if}
                    </div>
                {/foreach}
            {else}
                <div class="myTable-data" style="padding: 10px"><label>No data to display.</label></div>
            {/if}
        </div>
    </div>
</div>

<hr>

{/block}