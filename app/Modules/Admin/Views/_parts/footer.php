<?php if (session()->get('logged_in')): ?>
<footer class="text-center py-3 bg-light border-top">
    Powered by <a href="https://github.com/kirilkirkov" target="_blank">Kiril Kirkov</a>
</footer>
<?php endif; ?>

<!-- Modal Calculator -->
<div class="modal fade" id="modalCalculator" tabindex="-1" role="dialog" aria-labelledby="calculatorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <!-- Modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="calculatorLabel">
                    <i class="fa fa-calculator"></i> <?= lang('calculator') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="<?= lang('close') ?>">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="calculator">
                <div class="container-fluid">
                    <!-- Screen -->
                    <div class="row mb-3">
                        <div class="col-sm-8">
                            <div id="calculator-screen" class="form-control"></div>
                        </div>
                        <div class="col-sm-1 d-flex align-items-center justify-content-center">
                            =
                        </div>
                        <div class="col-sm-3">
                            <div id="calculator-result" class="form-control">0</div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="card mb-3">
                        <div class="card-body text-center" id="calc-board">
                            <div class="btn-group d-flex mb-2">
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-constant="SIN" data-key="115">sin</a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-constant="COS" data-key="99">cos</a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-constant="MOD" data-key="109">md</a>
                                <a href="javascript:void(0);" class="btn btn-danger flex-fill" data-method="reset" data-key="8">C</a>
                            </div>
                            <div class="btn-group d-flex mb-2">
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-key="55">7</a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-key="56">8</a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-key="57">9</a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-constant="BRO" data-key="40">(</a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-constant="BRC" data-key="41">)</a>
                            </div>
                            <div class="btn-group d-flex mb-2">
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-key="52">4</a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-key="53">5</a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-key="54">6</a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-constant="MIN" data-key="45">-</a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-constant="SUM" data-key="43">+</a>
                            </div>
                            <div class="btn-group d-flex mb-2">
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-key="49">1</a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-key="50">2</a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-key="51">3</a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-constant="DIV" data-key="47">/</a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-constant="MULT" data-key="42">*</a>
                            </div>
                            <div class="btn-group d-flex">
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-key="46">.</a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-key="48">0</a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary flex-fill" data-constant="PROC" data-key="37">%</a>
                                <a href="javascript:void(0);" class="btn btn-primary flex-fill" data-method="calculate" data-key="61">=</a>
                            </div>
                        </div>
                    </div>

                    <!-- History -->
                    <div class="card">
                        <div class="card-header">
                            <?= lang('history') ?>
                        </div>
                        <div class="card-body" id="calc-panel">
                            <ol id="calc-history-list" class="mb-0"></ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= lang('close') ?></button>
            </div>
        </div>
    </div>
</div>
