const initStuDatePickers = () => {
    const fromPickers = document.querySelectorAll(".datepicker-from");
    const toPickers = document.querySelectorAll(".datepicker-to");

    // We only support ONE pair per page for now based on current logic
    // but we'll loop to be safe although the global state should be managed per pair
    fromPickers.forEach((fromEl, index) => {
        const toEl = toPickers[index];
        if (!toEl) return;

        let fromDate = null;
        let toDate = null;

        let fromPicker, toPicker;

        const updateRangeHighlight = () => {
            if (fromPicker) fromPicker.redraw();
            if (toPicker) toPicker.redraw();
        };

        const commonConfig = {
            dateFormat: "d/m/Y",
            allowInput: true,
            altInput: true,
            altFormat: "d F Y",
            placeholder: "dd/mm/yyyy",
            disableMobile: true,
            onDayCreate: function (dObj, dStr, fp, dayElem) {
                const current = dayElem.dateObj.getTime();

                // 1. Static range highlight (when both dates are selected)
                if (fromDate && toDate) {
                    const start = fromDate.getTime();
                    const end = toDate.getTime();
                    if (current > start && current < end) {
                        dayElem.classList.add("manual-in-range");
                    }
                }

                // 2. Date Reference Indicator (The OTHER date)
                if (
                    fp.input.id === fromEl.id &&
                    toDate &&
                    current === toDate.getTime()
                ) {
                    dayElem.classList.add("date-reference");
                } else if (
                    fp.input.id === toEl.id &&
                    fromDate &&
                    current === fromDate.getTime()
                ) {
                    dayElem.classList.add("date-reference");
                }
            },
            onOpen: function (selectedDates, dateStr, fp) {
                const container = fp.calendarContainer;

                container.addEventListener("mouseover", (e) => {
                    const day = e.target.closest(".flatpickr-day");
                    if (!day || !day.dateObj) return;

                    const hoverTime = day.dateObj.getTime();
                    const days = container.querySelectorAll(".flatpickr-day");

                    days.forEach((el) => {
                        if (!el.dateObj) return;
                        const elTime = el.dateObj.getTime();
                        el.classList.remove("manual-in-range");

                        // 1. Hover Range Preview: From selected, hovering in To picker
                        if (fromDate && fp.input.id === toEl.id) {
                            if (
                                elTime > fromDate.getTime() &&
                                elTime < hoverTime
                            ) {
                                el.classList.add("manual-in-range");
                            }
                        }
                        // 2. Hover Range Preview: To selected, hovering in From picker
                        else if (toDate && fp.input.id === fromEl.id) {
                            if (
                                elTime < toDate.getTime() &&
                                elTime > hoverTime
                            ) {
                                el.classList.add("manual-in-range");
                            }
                        }
                        // 3. Static Range: Fallback
                        else if (fromDate && toDate) {
                            if (
                                elTime > fromDate.getTime() &&
                                elTime < toDate.getTime()
                            ) {
                                el.classList.add("manual-in-range");
                            }
                        }
                    });
                });

                container.addEventListener("mouseleave", () => {
                    if (!fromDate || !toDate) {
                        container
                            .querySelectorAll(".flatpickr-day")
                            .forEach((el) => {
                                el.classList.remove("manual-in-range");
                            });
                    }
                });
            },
        };

        fromPicker = flatpickr(fromEl, {
            ...commonConfig,
            onChange: function (selectedDates, dateStr) {
                fromDate = selectedDates[0] || null;
                if (toPicker) toPicker.set("minDate", dateStr || null);
                updateRangeHighlight();
            },
        });

        toPicker = flatpickr(toEl, {
            ...commonConfig,
            onChange: function (selectedDates, dateStr) {
                toDate = selectedDates[0] || null;
                if (fromPicker) fromPicker.set("maxDate", dateStr || null);
                updateRangeHighlight();
            },
        });
    });
};

export default initStuDatePickers;
