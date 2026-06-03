import re

css_file = 'public/css/home.css'

with open(css_file, 'r') as f:
    css_content = f.read()

# Add to :root
root_additions = """    --bg: var(--bg-primary);
    --bg-card: var(--bg-primary);
    --text: var(--text-primary);
    --text-dim: var(--text-secondary);
    --border: var(--border-color);
    --font: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    --font-display: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
"""

dark_additions = """    --bg: var(--bg-primary);
    --bg-card: var(--bg-hover);
    --text: var(--text-primary);
    --text-dim: var(--text-secondary);
    --border: var(--border-color);
"""

# Insert into :root
if "--bg-card" not in css_content:
    css_content = re.sub(r'(:root\s*\{)', r'\1\n' + root_additions, css_content)
    css_content = re.sub(r'(\[data-theme="dark"\]\s*\{)', r'\1\n' + dark_additions, css_content)

with open(css_file, 'w') as f:
    f.write(css_content)

print("Added missing variable mappings to home.css")
