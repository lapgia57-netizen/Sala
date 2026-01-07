// salary_calculator.rsx
// Dùng Dioxus + dioxus-desktop hoặc dioxus-web để chạy
// Cần thêm dependency: dioxus = { version = "0.5", features = ["desktop"] } (hoặc web)

#![allow(non_snake_case)]

use dioxus::prelude::*;

#[derive(Clone, Copy, PartialEq)]
enum SalaryType {
    Gross,
    Net,
}

#[component]
pub fn SalaryCalculator() -> Element {
    let mut gross_salary = use_signal(|| 15000000.0); // default 15tr
    let mut salary_type = use_signal(|| SalaryType::Gross);
    let mut dependents = use_signal(|| 0); // số người phụ thuộc

    // Tính toán
    let bhxh = *gross_salary * 0.08;
    let bhyt = *gross_salary * 0.015;
    let bhtn = *gross_salary * 0.01;
    let total_insurance = bhxh + bhyt + bhtn;

    let reduce_insurance = total_insurance;
    let reduce_family = 4_400_000.0 * (*dependents as f64 + 1.0); // bản thân + người phụ thuộc
    let taxable_income = (*gross_salary - reduce_insurance - reduce_family).max(0.0);

    let tax = calculate_pit(taxable_income);

    let net_salary = *gross_salary - total_insurance - tax;

    // Ngược lại: từ Net ra Gross (ước lượng gần đúng)
    let estimated_gross = if *salary_type == SalaryType::Net {
        estimate_gross_from_net(*gross_salary, *dependents)
    } else {
        *gross_salary
    };

    rsx! {
        div { class: "container mx-auto p-6 max-w-2xl",
            h1 { class: "text-3xl font-bold mb-6 text-center text-blue-700",
                "Công cụ tính lương Gross ↔ Net (Việt Nam 2026)"
            }

            div { class: "grid grid-cols-1 md:grid-cols-2 gap-6 mb-8",
                div {
                    label { class: "block text-sm font-medium mb-1", "Loại lương" }
                    select {
                        class: "w-full p-2 border rounded",
                        onchange: move |evt| {
                            let val = evt.value();
                            salary_type.set(if val == "gross" { SalaryType::Gross } else { SalaryType::Net });
                        },
                        option { value: "gross", "Gross (tổng lương trước trừ)" }
                        option { value: "net", "Net (lương thực nhận)" }
                    }
                }

                div {
                    label { class: "block text-sm font-medium mb-1", "Số người phụ thuộc" }
                    input {
                        r#type: "number",
                        class: "w-full p-2 border rounded",
                        min: "0",
                        value: "{dependents}",
                        onchange: move |evt| {
                            if let Ok(num) = evt.value().parse::<i32>() {
                                dependents.set(num.max(0));
                            }
                        }
                    }
                }
            }

            div { class: "mb-6",
                label { class: "block text-sm font-medium mb-1",
                    if *salary_type == SalaryType::Gross { "Lương Gross" } else { "Lương Net" }
                }
                input {
                    r#type: "number",
                    class: "w-full p-3 border-2 border-blue-500 rounded text-xl font-semibold",
                    value: "{format_number(*gross_salary)}",
                    onchange: move |evt| {
                        if let Ok(num) = evt.value().parse::<f64>() {
                            gross_salary.set(num.max(0.0));
                        }
                    }
                }
                p { class: "text-sm text-gray-500 mt-1", "(Nhập số tiền, ví dụ: 15000000)" }
            }

            div { class: "bg-gray-100 p-6 rounded-lg shadow",
                h2 { class: "text-xl font-semibold mb-4", "Kết quả tính toán" }

                if *salary_type == SalaryType::Gross {
                    DetailRow { label: "Lương Gross", value: *gross_salary }
                    DetailRow { label: "BHXH (8%)", value: -bhxh }
                    DetailRow { label: "BHYT (1.5%)", value: -bhyt }
                    DetailRow { label: "BHTN (1%)", value: -bhtn }
                    DetailRow { label: "Tổng bảo hiểm bắt buộc", value: -total_insurance }
                    DetailRow { label: "Giảm trừ gia cảnh", value: -reduce_family }
                    DetailRow { label: "Thu nhập chịu thuế", value: taxable_income }
                    DetailRow { label: "Thuế TNCN phải nộp", value: -tax }
                    hr { class: "my-3" }
                    DetailRow { label: "Lương Net thực nhận", value: net_salary, highlight: true }
                } else {
                    DetailRow { label: "Lương Net thực nhận", value: *gross_salary, highlight: true }
                    p { class: "text-center text-lg font-medium text-blue-600 mt-4",
                        "Lương Gross ước tính: {format_number(estimated_gross.round())} VNĐ"
                    }
                    p { class: "text-sm text-gray-500 text-center mt-1 italic",
                        "(chỉ mang tính tham khảo - nên tính ngược chính xác bằng công cụ chuyên dụng)"
                    }
                }
            }

            p { class: "text-center text-sm text-gray-500 mt-8",
                "Lưu ý: Công thức tham khảo theo quy định hiện hành 2026. Không thay thế tư vấn kế toán chuyên nghiệp."
            }
        }
    }
}

// Component nhỏ hiển thị dòng chi tiết
#[component]
fn DetailRow(label: String, value: f64, #[props(default = false)] highlight: bool) -> Element {
    let color = if value < 0.0 { "text-red-600" } else { "text-green-700" };
    let font_weight = if highlight { "font-bold text-xl" } else { "font-medium" };

    rsx! {
        div { class: "flex justify-between py-2 border-b",
            span { class: "text-gray-700", "{label}:" }
            span { class: "{color} {font_weight}", "{format_number(value)} VNĐ" }
        }
    }
}

// Hàm tính thuế TNCN lũy tiến 2025-2026
fn calculate_pit(income: f64) -> f64 {
    let brackets = [
        (5_000_000.0, 0.05),
        (5_000_000.0, 0.10),
        (8_000_000.0, 0.15),
        (14_000_000.0, 0.20),
        (20_000_000.0, 0.25),
        (28_000_000.0, 0.30),
        (f64::MAX, 0.35),
    ];

    let mut tax = 0.0;
    let mut remaining = income;
    let mut prev_limit = 0.0;

    for &(limit, rate) in brackets.iter() {
        let bracket_size = limit - prev_limit;
        if remaining > bracket_size {
            tax += bracket_size * rate;
            remaining -= bracket_size;
        } else {
            tax += remaining * rate;
            break;
        }
        prev_limit = limit;
    }

    tax
}

// Ước lượng ngược Gross từ Net (gần đúng)
fn estimate_gross_from_net(net: f64, dependents: i32) -> f64 {
    let mut guess = net * 1.25; // guess ban đầu
    for _ in 0..30 {
        let insurance = guess * 0.105;
        let family_deduction = 4_400_000.0 * (dependents as f64 + 1.0);
        let taxable = (guess - insurance - family_deduction).max(0.0);
        let tax = calculate_pit(taxable);
        let calculated_net = guess - insurance - tax;

        if (calculated_net - net).abs() < 1_000.0 {
            return guess;
        }

        // Dùng phương pháp Newton đơn giản hóa
        guess += (net - calculated_net) * 1.15;
    }
    guess
}

// Format số đẹp 15,000,000
fn format_number(num: f64) -> String {
    let s = format!("{:.0}", num);
    s.as_bytes()
        .rchunks(3)
        .rev()
        .map(|chunk| std::str::from_utf8(chunk).unwrap())
        .collect::<Vec<_>>()
        .join(",")
}
