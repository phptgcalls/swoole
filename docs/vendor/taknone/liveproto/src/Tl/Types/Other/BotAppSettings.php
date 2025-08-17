<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes placeholder_path int background_color int background_dark_color int header_color int header_dark_color
 * @return BotAppSettings
 */

final class BotAppSettings extends Instance {
	public function request(? string $placeholder_path = null,? int $background_color = null,? int $background_dark_color = null,? int $header_color = null,? int $header_dark_color = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc99b1950);
		$flags = 0;
		$flags |= is_null($placeholder_path) ? 0 : (1 << 0);
		$flags |= is_null($background_color) ? 0 : (1 << 1);
		$flags |= is_null($background_dark_color) ? 0 : (1 << 2);
		$flags |= is_null($header_color) ? 0 : (1 << 3);
		$flags |= is_null($header_dark_color) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		if(is_null($placeholder_path) === false):
			$writer->tgwriteBytes($placeholder_path);
		endif;
		if(is_null($background_color) === false):
			$writer->writeInt($background_color);
		endif;
		if(is_null($background_dark_color) === false):
			$writer->writeInt($background_dark_color);
		endif;
		if(is_null($header_color) === false):
			$writer->writeInt($header_color);
		endif;
		if(is_null($header_dark_color) === false):
			$writer->writeInt($header_dark_color);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['placeholder_path'] = $reader->tgreadBytes();
		else:
			$result['placeholder_path'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['background_color'] = $reader->readInt();
		else:
			$result['background_color'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['background_dark_color'] = $reader->readInt();
		else:
			$result['background_dark_color'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['header_color'] = $reader->readInt();
		else:
			$result['header_color'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['header_dark_color'] = $reader->readInt();
		else:
			$result['header_dark_color'] = null;
		endif;
		return new self($result);
	}
}

?>