package main

import "fmt"

type Singer struct {
    Name   string
    Reason string
}

func main() {
    korean := []Singer{
        {"1. IU", "Queen of K-pop, ảnh hưởng lớn với ballad và diễn xuất"},
        {"2. Jennie (BLACKPINK)", "Solo thành công lớn với album Ruby"},
        {"3. Rosé (BLACKPINK)", "Hit Apt. toàn cầu, vocal cảm xúc"},
        {"4. Lisa (BLACKPINK)", "Solo record-breaking, follower cao nhất"},
        {"5. Taeyeon", "Vocal queen huyền thoại"},
    }

    chinese := []Singer{
        {"1. Faye Wong (Vương Phi)", "Heavenly Queen huyền thoại"},
        {"2. G.E.M. (Đặng Tử Kỳ)", "Vocal powerhouse, tour thế giới"},
        {"3. Na Ying (Na Anh)", "Diva mainland, vocal khổng lồ"},
        {"4. Zhang Bichen (Trương Bích Thần)", "Hit OST nổi bật"},
        {"5. Single Yi Chun (Đơn Y Thuần)", "Rising star live mạnh mẽ"},
    }

    vietnamese := []Singer{
        {"1. Mỹ Tâm", "Nữ hoàng V-pop, fanbase lớn nhất"},
        {"2. Hoàng Thùy Linh", "Hit See Tình viral toàn cầu"},
        {"3. Hòa Minzy", "Bùng nổ với Bắc Bling 2025"},
        {"4. Mỹ Linh", "Tứ đại diva kinh điển"},
        {"5. Phương Mỹ Chi", "Young star dân gian đương đại"},
    }

    fmt.Println("Top 5 Diva Hàn Quốc nổi tiếng nhất 2025:")
    for _, s := range korean {
        fmt.Println(s.Name, "-", s.Reason)
    }

    fmt.Println("\nTop 5 Diva Trung Quốc nổi tiếng nhất 2025:")
    for _, s := range chinese {
        fmt.Println(s.Name, "-", s.Reason)
    }

    fmt.Println("\nTop 5 Diva Việt Nam nổi tiếng nhất 2025:")
    for _, s := range vietnamese {
        fmt.Println(s.Name, "-", s.Reason)
    }
}
