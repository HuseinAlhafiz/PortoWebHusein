import re
import os

css_file = 'public/css/home.css'

with open(css_file, 'r') as f:
    css_content = f.read()

# Define regex replacements for home.css
replacements = [
    # Backgrounds
    (r'background(?:-color)?:\s*#ffffff', r'background-color: var(--bg-primary)'),
    (r'background(?:-color)?:\s*#f9fafb', r'background-color: var(--bg-secondary)'),
    (r'background(?:-color)?:\s*#111827', r'background-color: var(--bg-dark)'),
    (r'background(?:-color)?:\s*#374151', r'background-color: var(--bg-alt)'),
    (r'background(?:-color)?:\s*#f3f4f6', r'background-color: var(--bg-hover)'),

    # Text Colors
    (r'color:\s*#111827', r'color: var(--text-primary)'),
    (r'color:\s*#6b7280', r'color: var(--text-secondary)'),
    (r'color:\s*#374151', r'color: var(--text-muted)'),
    (r'color:\s*#9ca3af', r'color: var(--text-lighter)'),
    (r'color:\s*#ffffff', r'color: var(--text-inverse)'),
    (r'color:\s*#f3f4f6', r'color: var(--text-inverse-muted)'),
    
    # Borders
    (r'border(?:-color)?:\s*#e5e7eb', r'border-color: var(--border-color)'),
    (r'border(?:-color)?:\s*#d1d5db', r'border-color: var(--border-strong)'),
    (r'1px solid #e5e7eb', r'1px solid var(--border-color)'),
    (r'1px solid #d1d5db', r'1px solid var(--border-strong)'),
]

for old, new in replacements:
    css_content = re.sub(old, new, css_content, flags=re.IGNORECASE)

# Insert CSS variables at the beginning
css_vars = """/* ========== CSS VARIABLES (Apple Style Dark Mode) ========== */
:root {
    --bg-primary: #ffffff;
    --bg-secondary: #f9fafb;
    --bg-alt: #374151; /* Dark Gray for some sections in light mode */
    --bg-dark: #111827; /* Dark background */
    --bg-hover: #f3f4f6;
    
    --text-primary: #111827;
    --text-secondary: #6b7280;
    --text-muted: #374151;
    --text-lighter: #9ca3af;
    --text-inverse: #ffffff;
    --text-inverse-muted: #f3f4f6;
    
    --border-color: #e5e7eb;
    --border-strong: #d1d5db;
    
    --accent: #7c3aed;
    --accent-hover: #6d28d9;
}

[data-theme="dark"] {
    /* Apple Dark Mode Palette */
    --bg-primary: #000000;
    --bg-secondary: #1c1c1e;
    --bg-alt: #1c1c1e; 
    --bg-dark: #1c1c1e;
    --bg-hover: #2c2c2e;
    
    --text-primary: #f5f5f7;
    --text-secondary: #86868b;
    --text-muted: #86868b;
    --text-lighter: #6e6e73;
    --text-inverse: #f5f5f7;
    --text-inverse-muted: #86868b;
    
    --border-color: #38383a;
    --border-strong: #48484a;
    
    --accent: #a855f7; /* Slightly brighter purple for dark mode */
    --accent-hover: #c084fc;
}

"""

if "/* ========== CSS VARIABLES" not in css_content:
    css_content = css_vars + css_content

with open(css_file, 'w') as f:
    f.write(css_content)

print("home.css updated successfully!")
