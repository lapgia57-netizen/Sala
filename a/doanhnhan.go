package main

import "fmt"

type Entrepreneur struct {
    Rank   string
    Name   string
    Reason string
}

func main() {
    entrepreneurs := []Entrepreneur{
        {"1.", "Elon Musk", "CEO Tesla/SpaceX/xAI - Giàu nhất thế giới, dẫn đầu AI và không gian"},
        {"2.", "Jensen Huang", "CEO Nvidia - Đứng đầu Fortune 2025 nhờ AI boom"},
        {"3.", "Mark Zuckerberg", "CEO Meta - Đổi mới mạng xã hội và VR/AR"},
        {"4.", "Jeff Bezos", "Founder Amazon - Đế chế e-commerce và cloud"},
        {"5.", "Larry Ellison", "Founder Oracle - Tiên phong AI cloud"},
        {"6.", "Larry Page", "Co-founder Google - Ảnh hưởng lớn qua Alphabet"},
        {"7.", "Sergey Brin", "Co-founder Google - Đồng hành innovation AI"},
        {"8.", "Steve Ballmer", "Former CEO Microsoft - Tài sản khổng lồ từ tech"},
        {"9.", "Bernard Arnault", "CEO LVMH - Ông trùm luxury toàn cầu"},
        {"10.", "Warren Buffett", "CEO Berkshire Hathaway - Huyền thoại đầu tư"},
    }

    fmt.Println("Top 10 Doanh nhân xuất sắc nhất thế giới 2025:")
    for _, e := range entrepreneurs {
        fmt.Println(e.Rank, e.Name, "-", e.Reason)
    }
}
