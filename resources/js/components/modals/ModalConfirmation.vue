<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container">
                <div class="modal-header">
                    <slot name="title"/>
                    <button type="button" class="btn-close"
                            @click="$emit('close')"
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
        name: "ModalConfirmation",
        emits: ["confirmation", "removeMovie"],
    }
</script>

<style scoped>
    .modal-container {
        width: 300px;
    }
</style>
