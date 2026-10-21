from PIL import Image

img = Image.open('design/design.png')
w, h = img.size

# Let's inspect rows with text or section transitions
# Look for background color changes along x=20
prev_color = None
transitions = []
for y in range(h):
    color = img.getpixel((20, y))
    # consider significant color change
    if prev_color is not None:
        diff = sum(abs(c1 - c2) for c1, c2 in zip(color[:3], prev_color[:3]))
        if diff > 60:
            transitions.append((y, color))
    prev_color = color

print("Major color transitions at x=20:")
for t in transitions[:30]:
    print(t)
