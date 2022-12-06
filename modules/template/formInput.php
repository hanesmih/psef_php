<?php
function displayTextInputRow(
  string $label,
  string $inputType,
  string $inputValue,
  string $inputName,
  string $inputPlaceholder,
  string $checkValue,
  string $checkName,
  string $reasonValue,
  string $reasonName,
  string $reasonPlaceholder,
  bool $inputEnabled,
  bool $checkEnabled
) {
  $inputState = $inputEnabled ? "" : "disabled";
  $inputRequired = $inputEnabled ? "required" : "";
  $checkState = $checkEnabled ? "" : "disabled";
  $checkRequired = $checkEnabled ? "required" : "";
?>
  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
        <label class="control-label"><?php echo $label; ?></label>
        <input type="<?php echo $inputType; ?>" class="form-control" name="<?php echo $inputName; ?>" value="<?php echo $inputValue; ?>" placeholder="<?php echo $inputPlaceholder; ?>" <?php echo $inputRequired; ?> <?php echo $inputState; ?> />
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group text-center">
        <label class="control-label">Sesuai</label>
        <input type="checkbox" class="form-control mt-2 check-large" name="<?php echo $checkName; ?>" value="<?php echo $checkValue; ?>" <?php echo $checkState; ?> />
      </div>
    </div>

    <div class="col-md-5">
      <div class="form-group">
        <label class="control-label">Keterangan</label>
        <textarea class="form-control" name="<?php echo $reasonName; ?>" placeholder="<?php echo $reasonPlaceholder; ?>" <?php echo $checkRequired; ?> <?php echo $checkState; ?>><?php echo $reasonValue; ?></textarea>
      </div>
    </div>
  </div>
<?php
}

function displayFileInputRow(
  string $label,
  string $fileUrl,
  string $fileName,
  string $inputName,
  string $closeElementId,
  string $inputElementId,
  string $hiddenInputElementId,
  string $checkValue,
  string $checkName,
  string $reasonValue,
  string $reasonName,
  string $reasonPlaceholder,
  bool $inputEnabled,
  bool $checkEnabled
) {
  $inputState = $inputEnabled ? "" : "disabled";
  $inputRequired = $inputEnabled ? "required" : "";
  $checkState = $checkEnabled ? "" : "disabled";
  $checkRequired = $checkEnabled ? "required" : "";
?>
  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
        <label>
          <?php echo $label; ?>
        </label>

        <div>
          <a class="btn btn-block btn-outline-secondary text-left" href="<?php echo $fileUrl; ?>" target="_blank" id="<?php echo $closeElementId; ?>">
          <i class="fa fa-file mr-2"></i><?php echo $fileName; ?>
          </a>
        </div>

        <?php
        if ($inputEnabled) {
        ?>
          <input type="file" class="form-control" id="<?php echo $inputElementId; ?>" />

          <small class="form-text text-muted">
            *Berkas yang anda upload wajib PDF & size file maksimal 5 MB
          </small>

          <input type="hidden" name="<?php echo $inputName; ?>" id="<?php echo $hiddenInputElementId; ?>" />
        <?php
        }
        ?>
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group text-center">
        <label class="control-label">Sesuai</label>
        <input type="checkbox" class="form-control mt-2 check-large" name="<?php echo $checkName; ?>" value="<?php echo $checkValue; ?>" <?php echo $checkState; ?> />
      </div>
    </div>

    <div class="col-md-5">
      <div class="form-group">
        <label class="control-label">Keterangan</label>
        <textarea class="form-control" name="<?php echo $reasonName; ?>" placeholder="<?php echo $reasonPlaceholder; ?>" <?php echo $checkRequired; ?> <?php echo $checkState; ?>><?php echo $reasonValue; ?></textarea>
      </div>
    </div>
  </div>

<?php
}

