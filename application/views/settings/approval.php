<select id="approval" name="approval" class="form-control setting" data-settingid="<?= $setting->setting_id ?>">
    <option value="1" <?= $value == 1 ? "selected" : "" ?>>On</option>
    <option value="0" <?= $value == 0 ? "selected" : "" ?>>Off</option>
</select>