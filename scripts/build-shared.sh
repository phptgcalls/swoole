#!/bin/bash
set -e

echo "Starting Swoole build process for Linux..."

# Clone Swoole source if not present
if [ ! -d "swoole-src" ]; then
  echo "Cloning Swoole source repository..."
  git clone --depth=1 https://github.com/swoole/swoole-src.git
fi

# Enter the Swoole source directory
cd swoole-src

# Run phpize in the top-level Swoole directory (which contains config.m4)
echo "Running phpize..."
phpize

echo "Configuring the build..."
# You can pass additional configuration flags as needed
./configure --enable-swoole

echo "Compiling the Swoole extension..."
make -j$(nproc)

# Return to repository root
cd ..

# Create output directory if it doesn't exist
mkdir -p build/output

# Check and copy the built shared library to the output directory
if [ -f swoole-src/modules/swoole.so ]; then
  cp swoole-src/modules/swoole.so build/output/
  echo "Swoole shared library built successfully at build/output/swoole.so"
else
  echo "Error: Build failed. swoole-src/modules/swoole.so not found."
  exit 1
fi
