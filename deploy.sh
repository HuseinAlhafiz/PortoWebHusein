#!/bin/bash

# Pastikan jika ada error, script akan berhenti
set -e

# Prompt pesan commit dari user
echo "=== Git Auto Deploy Helper ==="
read -p "Masukkan pesan commit (kosongkan untuk default 'update: website changes'): " commit_message

if [ -z "$commit_message" ]; then
    commit_message="update: website changes"
fi

# Git Add
echo "Mengumpulkan semua perubahan..."
git add .

# Git Commit
echo "Melakukan commit dengan pesan: '$commit_message'..."
git commit -m "$commit_message"

# Git Push
echo "Mengirim perubahan ke GitHub (branch main)..."
git push origin main

echo ""
echo "============================================="
echo "🎉 Sukses! Perubahan telah ter-push ke GitHub."
echo "Proses deploy otomatis (GitHub Actions) sedang berjalan."
echo "Anda bisa memantaunya di: https://github.com/HuseinAlhafiz/PortoWebHusein/actions"
echo "============================================="
