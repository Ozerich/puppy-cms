<ul id="crumbs">
    <li><a href="admin/cities">Города</a></li>
    <li><span>Настройки города <?=$city->name?></a></span></li>
</ul>

<?=
form_open("admin/cities/".$city->id)
; ?>
<div id="city-data">
    <div class="main-info">
        <div class="param">
            <label for="name">Название:</label>
            <input type="text" name="name" value="<?=$city->name?>" id="name" maxlength="20"/>
        </div>
        <div class="param">
            <label for="alias">URL-alias:</label>
            <input type="text" name="alias" value="<?=$city->alias?>" id="alias" maxlength="20"/>
        </div>
    </div>
    <div class="finance-block">
        <p class="block-header">Настройки финансов</p>

        <div class="finance-content">
            <div class="param">
                <label for="valute">Денежная еденица:</label>
                <input type="text" name="valute" id="valute" value="<?=$city->valute?>" maxlength="10">
            </div>
            <table class="commission-table item-list">
                <thead
                <tr>
                    <th>От</th>
                    <th>До</th>
                    <th>Комиссия</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <? if ($city->commissions): foreach ($city->commissions as $commission): ?>
                <tr>
                    <input type="hidden" class="commission_id" value="<?=$commission->id?>"/>
                    <td><?=$commission->from?></td>
                    <td><?=$commission->to?></td>
                    <td><?=$commission->value?></td>
                    <td>
                        <a href="#" class="delete-commission delete-link"></a>
                    </td>
                </tr>
                    <? endforeach; else: ?>
                <tr class="empty">
                    <td colspan="10">Нет комиссии</td>
                </tr>
                    <? endif; ?>
                </tbody>
            </table>
            <div class="newcommission-block">
                <label for="from">От:</label>
                <input type="text" name="from" id="from" maxlength="9"/>
                <label for="to">До:</label>
                <input type="text" name="to" id="to" maxlength="9"/>
                <label for="value">Комиссия:</label>
                <input type="text" name="value" id="value" maxlength="9"/>
                <button id="newcommission-submit" class="noimg">Добавить</button>
            </div>
        </div>
    </div>
    <input type="submit" id="city-submit" class="noimg" value="Сохранить"/>
</div>

</form>
