# Количество символов в поле

```js
class countLetters {
        constructor(id, maxCount = 0) {
            this.id = id.replace('#', '');
            this.fieldSelector = document.querySelector(`#${id}`);
            this.countSelector = document.querySelector(`[data-count-letters="${id}"]`);
            this.maxCount = Number(maxCount);

            if (this.checkFields) {
                this.init();
            }
        }

        checkFields() {
            return this.fieldSelector !== null && this.countSelector !== null;
        }

        getCountLetters() {
            if (this.maxCount === 0) {
                return this.fieldSelector.value.length;
            }

            return this.maxCount - this.fieldSelector.value.length;
        }

        setCount(count) {
            this.countSelector.textContent = count;
        }

        checkChangeField() {
            this.fieldSelector.addEventListener('input', () => {
                const currentCount = this.getCountLetters();


                if (this.maxCount === 0) {
                    this.setCount(currentCount);

                    return;
                }

                this.fieldSelector.value = this.fieldSelector.value.slice(0, this.maxCount);

                this.setCount(this.getCountLetters());
            });
        }

        init() {
            this.setCount(this.getCountLetters());

            this.checkChangeField();
        }
    }

    new countLetters('description', 150);
```
