from PIL import Image, ImageDraw, ImageFont
import os

os.makedirs("public/images", exist_ok=True)

img = Image.new("RGB", (800, 800), "white")
draw = ImageDraw.Draw(img)

blue = (20, 100, 210)
dark_blue = (10, 55, 130)
gray = (90, 100, 110)

# Lingkaran logo
draw.ellipse((70, 70, 730, 730), outline=blue, width=25)

# Atap rumah
draw.polygon(
    [(150, 300), (400, 150), (650, 300)],
    fill=blue
)

# Rumah
draw.rectangle((230, 285, 570, 500), fill="white")

# Cerobong
draw.rectangle((500, 205, 555, 290), fill=blue)

# Jendela
draw.rectangle((350, 230, 450, 330), fill=blue)
draw.line((400, 230, 400, 330), fill="white", width=8)
draw.line((350, 280, 450, 280), fill="white", width=8)

# Tulisan SJ
font_sj = ImageFont.truetype(
    "C:/Windows/Fonts/arialbd.ttf", 180
)

bbox = draw.textbbox((0, 0), "SJ", font=font_sj)
w = bbox[2] - bbox[0]
h = bbox[3] - bbox[1]

draw.text(
    ((800-w)/2, 315),
    "SJ",
    font=font_sj,
    fill=blue
)

# Garis dekorasi
draw.line((170, 525, 630, 525), fill=blue, width=12)

# Nama toko
font_name = ImageFont.truetype(
    "C:/Windows/Fonts/arialbd.ttf", 55
)

text = "TOKO SEMEN JAYA"
bbox = draw.textbbox((0, 0), text, font=font_name)
w = bbox[2] - bbox[0]

draw.text(
    ((800-w)/2, 570),
    text,
    font=font_name,
    fill=dark_blue
)

# Simpan sebagai PNG
img.save("public/images/logo.png", "PNG")

print("LOGO BERHASIL DIBUAT!")
print("Lokasi: public/images/logo.png")
