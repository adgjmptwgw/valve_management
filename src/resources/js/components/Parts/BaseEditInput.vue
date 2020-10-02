<template>
    <div>
        <p>
            <label for="edit_name">弁名称</label>
            <input type="text" id="edit_name" v-model="nameInput" />
        </p>
        <p>
            <label for="edit_number">弁番号</label>
            <input type="text" id="edit_number" v-model="numberInput" />
        </p>
        <p>
            <label for="edit_name">通常状態</label>
            <input
                type="text"
                id="edit_usually_state"
                v-model="usuallyStateInput"
            />
        </p>
        <p>
            <label for="edit_memo">メモ</label>
            <input type="text" id="edit_memo" v-model="memoInput" />
        </p>
        <button @click="sendOptionsData(), invisibleOthersOption()">保存</button>
    </div>
</template>

<script>
export default {
    props: {
        // 弁のid。元はデータベースからの取得したデータ。
        optionId: {
            default: ""
        },
        // 以下はオプション画面で表示する情報。弁番号と弁名称。
        optionName: {
            default: ""
        },
        optionNumber: {
            default: ""
        },
        // 弁の通常状態のデータ。通常状態の表示・非表示で用いる。
        optionUsuallyState: {
            default: ""
        },
        // 弁のメモデータ
        optionMemo: {
            default: ""
        }
    },
    data() {
        return {
            // 入力フォームに初期表示させる為に、直接データを代入。
            nameInput: this.optionName,
            numberInput: this.optionNumber,
            usuallyStateInput: this.optionUsuallyState,
            memoInput: this.optionMemo,
        };
    },
    methods: {
        sendOptionsData() {
            axios
                .put("/api/System/" + this.optionId, {
                    valve_name: this.nameInput,
                    valve_number: this.numberInput,
                    valve_usually_state: this.usuallyStateInput,
                    valve_memo: this.memoInput
                })
                .then(response => {
                    console.log(response);
                });
        },
        // 保存ボタンを押した際にその他オプションが消えるようにする。
        invisibleOthersOption: function() {
            this.$emit("push-save-button");
        }
    }
};
</script>

<style></style>
