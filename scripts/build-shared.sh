#!/bin/bash
set -e

echo "Starting Swoole build process for Linux..."

# Check for required PHP build tools
if ! command -v phpize &>/dev/null; then
  echo "Error: phpize is not installed. Please install the PHP development package."
  exit 1
fi

if ! command -v php-config &>/dev/null; then
  echo "Error: php-config is not installed. Please install the PHP development package."
  exit 1
fi

# Prepare the build environment (assumes you are in the Swoole source directory)
echo "Running phpize..."
phpize

echo "Configuring the build..."
# You can pass additional configure flags if needed (e.g. --enable-swoole, --with-ssl, etc.)
./configure --enable-swoole

echo "Compiling the Swoole extension..."
make -j$(nproc)

# Ensure output directory exists
mkdir -p build/output

# Check if the shared library was produced and copy it to build/output
if [ -f modules/swoole.so ]; then
  cp modules/swoole.so build/output/
  echo "Swoole shared library built successfully at build/output/swoole.so"
else
  echo "Error: Build failed. modules/swoole.so not found."
  exit 1
fi
