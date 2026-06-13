#!/bin/bash

# Pastikan jika ada error, script akan berhenti (kecuali yang di-handle)
set -e

echo "=== Git Auto Deploy Helper (SSH) ==="

# 1. Kompilasi aset Vite secara lokal agar masuk ke Git
echo "Mengompilasi aset lokal (Vite)..."
npm run build

# 2. Prompt pesan commit dari user
read -p "Masukkan pesan commit (kosongkan untuk default 'update: website changes'): " commit_message

if [ -z "$commit_message" ]; then
    commit_message="update: website changes"
fi

# Git Add
echo "Mengumpulkan semua perubahan..."
git add .

# Cek apakah ada perubahan yang siap dicommit
if git diff --cached --quiet; then
    echo "---------------------------------------------"
    echo "ℹ️ Tidak ada perubahan file yang baru untuk di-commit."
    read -p "Apakah Anda ingin tetap memicu (trigger) deploy ulang ke live hosting? (y/n): " force_deploy
    if [[ "$force_deploy" =~ ^[Yy]$ ]]; then
        echo "Memicu redeploy dengan push kosong..."
        git commit --allow-empty -m "trigger: redeploy website"
        git push origin main
        echo "============================================="
        echo "🎉 Sukses memicu redeploy ke GitHub."
        echo "Anda bisa memantaunya di: https://github.com/HuseinAlhafiz/PortoWebHusein/actions"
        echo "============================================="
    else
        echo "Deployment dibatalkan."
    fi
else
    # Melakukan commit
    echo "Melakukan commit dengan pesan: '$commit_message'..."
    git commit -m "$commit_message"

    # Melakukan push
    echo "Mengirim perubahan ke GitHub (branch main)..."
    git push origin main

    echo ""
    echo "============================================="
    echo "🎉 Sukses! Perubahan telah ter-push ke GitHub."
    echo "Proses deploy otomatis via SSH sedang berjalan."
    echo "Anda bisa memantaunya di: https://github.com/HuseinAlhafiz/PortoWebHusein/actions"
    echo "============================================="
fi
