#include <ncurses.h>
#include <stdlib.h>
#include <time.h>
#include <unistd.h>

#define MAX_COLUMNS 2000  // Đủ lớn để hỗ trợ màn hình rộng

int main() {
    // Khởi tạo ncurses
    initscr();
    curs_set(0);              // Ẩn con trỏ
    noecho();                 // Không hiển thị input
    nodelay(stdscr, TRUE);    // getch không blocking
    start_color();
    init_pair(1, COLOR_GREEN, COLOR_BLACK);

    int max_y, max_x;
    getmaxyx(stdscr, max_y, max_x);

    // Mảng lưu vị trí rơi của từng cột
    int drops[MAX_COLUMNS];
    int speeds[MAX_COLUMNS];  // Tốc độ rơi của từng cột (ngẫu nhiên)
    for (int i = 0; i < MAX_COLUMNS; i++) {
        drops[i] = -rand() % max_y;  // Bắt đầu từ trên màn hình (ngẫu nhiên)
        speeds[i] = 1 + rand() % 3;  // Tốc độ từ 1 đến 3
    }

    // Chuỗi ký tự Matrix (katakana + số + chữ cái)
    const char chars[] = "アァカサタナハマヤャラワガザダバパイィキシチニヒミリヰギジヂビピウゥクスツヌフムユュルグズブヅプエェケセテネヘメレヱゲゼデベペオォコソトノホモヨョロヲゴゾドボポヴッンABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%^&*()_+-=[]{}|;:',.<>?";

    int num_chars = sizeof(chars) - 1;

    // Hiệu ứng "Wake up, Neo..." (hiển thị ở giữa sau vài giây)
    int show_intro = 0;
    time_t start_time = time(NULL);

    while (1) {
        getmaxyx(stdscr, max_y, max_x);  // Cập nhật kích thước nếu terminal thay đổi

        int columns = max_x;  // Mỗi cột rộng 1 ký tự

        // Xóa màn hình bằng cách phủ lớp mờ (tạo trail effect)
        attron(COLOR_PAIR(1));
        attron(A_DIM);
        for (int x = 0; x < columns && x < MAX_COLUMNS; x++) {
            for (int y = 0; y < max_y; y++) {
                mvaddch(y, x, ' ' | A_DIM);
            }
        }
        attroff(A_DIM);

        // Vẽ các ký tự rơi
        attron(COLOR_PAIR(1));
        for (int x = 0; x < columns && x < MAX_COLUMNS; x++) {
            // Ký tự ngẫu nhiên
            char ch = chars[rand() % num_chars];

            int y = drops[x];

            if (y >= 0 && y < max_y) {
                // Đầu cột sáng hơn (màu trắng)
                if (y == drops[x] % max_y) {
                    attron(A_BOLD);
                    mvaddch(y, x, ch);
                    attroff(A_BOLD);
                } else {
                    mvaddch(y, x, ch);
                }

                // Đuôi mờ dần (các ký tự phía trên)
                for (int tail = 1; tail < 15 && y - tail >= 0; tail++) {
                    attron(A_DIM);
                    mvaddch(y - tail, x, chars[rand() % num_chars]);
                    attroff(A_DIM);
                }
            }

            // Cập nhật vị trí rơi
            drops[x] += speeds[x];
            if (drops[x] > max_y + 20) {  // Reset khi rơi hết màn hình
                drops[x] = -rand() % (max_y * 2);
                speeds[x] = 1 + rand() % 3;
            }
        }
        attroff(COLOR_PAIR(1));

        // Hiển thị thông điệp "Wake up, Neo..." sau 3 giây, biến mất sau 12 giây
        if (time(NULL) - start_time >= 3 && show_intro == 0) {
            show_intro = 1;
            attron(A_BOLD | COLOR_PAIR(1));
            mvprintw(max_y / 2 - 3, max_x / 2 - 20, "Wake up, Neo...");
            mvprintw(max_y / 2 - 1, max_x / 2 - 20, "The Matrix has you...");
            mvprintw(max_y / 2 + 1, max_x / 2 - 20, "Follow the white rabbit.");
            mvprintw(max_y / 2 + 3, max_x / 2 - 20, "Knock, knock, Neo.");
            attroff(A_BOLD | COLOR_PAIR(1));
        }
        if (time(NULL) - start_time >= 15) {
            show_intro = 0;  // Xóa thông điệp
        }

        refresh();
        usleep(50000);  // ~20 FPS (có thể điều chỉnh: nhỏ hơn = nhanh hơn)

        // Thoát khi nhấn phím q hoặc Q
        int ch = getch();
        if (ch == 'q' || ch == 'Q') {
            break;
        }
    }

    endwin();  // Kết thúc ncurses
    return 0;
}
