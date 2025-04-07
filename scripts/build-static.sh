#!/bin/bash
set -e

echo "Starting Swoole static library build process for Linux..."

# Clone Swoole source repository if it doesn't exist
if [ ! -d "swoole-src" ]; then
  echo "Cloning Swoole source repository..."
  git clone --depth=1 https://github.com/swoole/swoole-src.git
fi

# Navigate into the Swoole source directory
cd swoole-src

# Prepare the build environment using phpize
echo "Running phpize..."
phpize

# Configure the build for a static library
echo "Configuring build for static library..."
# The --disable-shared flag is used to disable building a shared module,
# which may encourage static linking; adjust flags if needed.
./configure --enable-swoole --disable-shared

# Compile the extension using all available CPU cores
echo "Compiling Swoole extension..."
make -j$(nproc)

# Create output directory if not present
cd ..
mkdir -p build/output

# Check for the static library file and copy it to build/output
if [ -f swoole-src/modules/swoole.a ]; then
  cp swoole-src/modules/swoole.a build/output/
  echo "Swoole static library built successfully at build/output/swoole.a"
else
  echo "Error: Build failed. Static library (modules/swoole.a) not found."
  exit 1
fi
