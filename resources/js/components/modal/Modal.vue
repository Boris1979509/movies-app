<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container">
                <div class="modal-header">
                    <slot name="title"/>
                    <button type="button" class="btn-close"
                            @click="$emit('confirmation', false)"
                    ></button>
                </div>
                <div class="modal-body">
                    <slot name="body"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            @click="$emit('confirmation', false)"
                    >Отмена
                    </button>
                    <button type="button" class="btn btn-primary"
                            @click="$emit('removeMovie')"
                    >Удалить
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Modal",
        emits: ["confirmation", "removeMovie"],
    }
</script>

<style scoped>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: table;
        transition: opacity 0.3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 300px;
        margin: 0 auto;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
        transition: all 0.3s ease;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }


    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>
