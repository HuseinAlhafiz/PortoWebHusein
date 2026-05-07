import re

with open('/Users/user/Documents/webAWI/resources/views/tracker/dashboard.blade.php', 'r') as f:
    content = f.read()

# Apple Background
content = content.replace('bg-[#f8f9fa]', 'bg-[#f5f5f7]')

# Card Styles
content = content.replace('border border-gray-200/80 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.04)] rounded-2xl p-8', 'border-0 shadow-[0_4px_24px_rgba(0,0,0,0.04)] rounded-[28px] p-8 md:p-10')
content = content.replace('border border-gray-100 shadow-[0_2px_10px_-3px_rgba(0,0,0,0.05)] rounded-2xl', 'border-0 shadow-[0_4px_24px_rgba(0,0,0,0.04)] rounded-[28px]')

# Section Header Text
content = content.replace('text-[20px] font-bold text-gray-900 tracking-tight', 'text-[24px] font-semibold text-[#1d1d1f] tracking-tight')

# Buttons
content = content.replace('bg-[#5d55fa] hover:bg-[#4f46e5] text-white font-semibold py-3 px-4 rounded-[4px]', 'bg-[#0071e3] hover:bg-[#0077ED] text-white font-medium py-3 px-6 rounded-full')
content = content.replace('rounded-xl shadow-sm transition-all text-nowrap', 'rounded-full transition-all text-nowrap')
content = content.replace('border border-blue-600 text-blue-600 hover:bg-blue-50 font-bold rounded-full', 'bg-[#0071e3] hover:bg-[#0077ED] text-white font-medium border-0 rounded-full')
content = content.replace('border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold rounded-full', 'bg-[#e8e8ed] hover:bg-[#d2d2d7] text-[#1d1d1f] font-medium border-0 rounded-full')

# Inputs
content = content.replace('border border-gray-300 rounded-[4px]', 'bg-[#f5f5f7] border-0 rounded-xl')
content = content.replace('border-2 border-[#4f46e5] rounded-[4px] py-3 px-3 text-[13px] text-gray-800 focus:outline-none focus:border-[#4f46e5] focus:ring-1 focus:ring-[#4f46e5] bg-white shadow-[0_0_8px_rgba(79,70,229,0.15)]', 'bg-[#f5f5f7] border-0 rounded-xl py-3 px-4 text-[14px] text-[#1d1d1f] focus:outline-none focus:ring-4 focus:ring-[#0071e3]/20 focus:bg-white transition-all')

# Modals
content = content.replace('rounded-2xl shadow-2xl p-6 sm:p-8', 'rounded-[28px] shadow-[0_20px_40px_rgba(0,0,0,0.12)] p-8 sm:p-10 border-0')

# Jadwal & Presensi highlight Card
content = content.replace('bg-gradient-to-r from-blue-50/50 to-indigo-50/50 border border-blue-100 shadow-sm rounded-2xl', 'bg-white border-0 shadow-[0_4px_24px_rgba(0,0,0,0.04)] rounded-[28px] relative overflow-hidden')

content = content.replace('bg-[#1b3668] hover:bg-[#152a51]', 'bg-[#0071e3] hover:bg-[#0077ED]')

# Fonts
content = content.replace('text-[30px] font-bold text-gray-900', 'text-[36px] font-semibold text-[#1d1d1f] tracking-tight')

with open('/Users/user/Documents/webAWI/resources/views/tracker/dashboard.blade.php', 'w') as f:
    f.write(content)

print("UI updated successfully.")
