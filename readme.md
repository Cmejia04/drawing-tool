# 🖼️ Console Drawing Application (Canvas)

This application allows you to create and manipulate a canvas using commands from an input file (`input.txt`).  
You can draw lines, rectangles, and fill areas using the **Bucket Fill** command, similar to simple graphic tools like Paint.

---

## 🚀 Main Features

- Create a canvas with a custom size.
- Draw horizontal and vertical lines.
- Draw rectangles.
- Fill areas with a specific character (`Bucket Fill`).
- Support multiple consecutive commands.
- Ignores empty or invalid lines in the input file.

---

## 🖌️ How to Use the Tool

The drawing tool works by reading a command file (`input.txt`), processing each command line by line, and generating a canvas displayed in the console and saved in an `output.txt` file.

### 🔹 Available Commands

| Command | Function | Syntax | Example |
|---------|---------|---------|---------|
| **C** | Create a new canvas | `C width height` | `C 20 10` |
| **L** | Draw a horizontal or vertical line | `L x1 y1 x2 y2` | `L 1 2 6 2` |
| **R** | Draw a rectangle | `R x1 y1 x2 y2` | `R 14 1 18 3` |
| **B** | Fill an area with a character (Bucket Fill) | `B x y c` | `B 10 3 o` |

> 🔹 **Important Notes:**
> - You can only draw after creating a canvas with `C`.
> - Diagonal lines are not supported.
> - Bucket Fill respects rectangles: if the starting point is inside a rectangle, only that rectangle is filled; if outside, the canvas background is filled.
> - Bucket Fill will only work if the starting coordinate is within the canvas boundaries.

---

## 🧱 Practical Example

**input.txt**

```txt
C 20 10
L 2 2 10 2
L 18 1 18 3
R 2 5 6 9
R 9 4 17 9
B 3 7 o

```

**Execution:**
```bash
  php bin/console app:drawing_tool
```

---

**Expected result in output.txt using the previous input.txt:**
```txt
----------------------
|                 x  |
| xxxxxxxxx       x  |
|                 x  |
|        xxxxxxxxx   |
| xxxxx  x       x   |
| xooox  x       x   |
| xooox  x       x   |
| xooox  x       x   |
| xxxxx  xxxxxxxxx   |
|                    |
----------------------
```

---

## 🧪 Tests Included (Basic Test Coverage)

- Canvas creation
- Drawing lines
- Drawing rectangles
- Bucket fill behaviors
- Handling invalid operations (like drawing before creating a canvas)

---

## 💡 About the solution

- The application reads commands from an input file and modifies a Canvas object step by step.  
- The code uses object-oriented design with separate classes for Canvas, Rectangle, and Commands, following SOLID principles.  
- Each command (CreateCanvas, DrawLine, DrawRectangle, BucketFill) encapsulates its own logic.  
- Bucket Fill only works within the canvas and respects rectangles.  
- This structure makes the solution easy to extend and maintain.
