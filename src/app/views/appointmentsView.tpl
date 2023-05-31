{extends file='main.tpl'}

{block name=content}

<h3 class="thin text-center">{$page_title}</h3>
<hr>

<div class="myContainer">
    <div class="myTable">
        <div class="myTable-header">
            <div class="header__item"><label>Imie</label></div>
            <div class="header__item"><label>Nazwisko</label></div>
            <div class="header__item"><label>Data</label></div>
            <div class="header__item"><label>Godzina</label></div>

        </div>
        <div class="myTable-content">
            {if !empty($data)}
                {foreach $data as $appointment}
                    <div class="myTable-row">
                        {foreach $appointment as $param}
                            {if strcmp($param, $appointment['name']) == 0}
                                <div class="myTable-data"><label>{$param}</label></div>
                            {elseif strcmp($param, $appointment['surname']) == 0}
                                <div class="myTable-data"><label>{$param}</label></div>
                            {elseif strcmp($param, $appointment['date']) == 0}
                                <div class="myTable-data"><label>{$param}</label></div>
                            {elseif strcmp($param, $appointment['time']) == 0}
                                <div class="myTable-data"><label>{$param}</label></div>
                            {/if}
                        {/foreach}
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