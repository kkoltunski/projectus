<div class="custom-select" style="width:175px">
    <select name="townSelect">
        <option value="0">Miasto:</option>
        {if !empty($townsData)}
            {foreach $townsData as $town}
                <option value={$town}>{$town}</option>
            {/foreach}
        {/if}
    </select>
</div>
<div class="custom-select" style="width:175px;">
    <select name="voivodeshipSelect">
        <option value="0">Województwo:</option>
        {if !empty($voivodeshipsData)}
            {foreach $voivodeshipsData as $voivodeship}
                <option value={$voivodeship}>{$voivodeship}</option>
            {/foreach}
        {/if}
    </select>
</div>
<div class="custom-select" style="width:175px;">
    <select name="specializationSelect">
        <option value="0">Specjalizacja:</option>
        {if !empty($specializationsData)}
            {foreach $specializationsData as $specialization}
                <option value={$specialization}>{$specialization}</option>
            {/foreach}
        {/if}
    </select>
</div>
<button class="btn btn-action" style="margin-left:100px" type="submit" name="buttonValue" value="search">Szukaj...</button>
<button class="btn btn-action" style="margin-left:15px" type="submit" name="buttonValue" value="reset">Resetuj</button>
