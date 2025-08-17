<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true blur true motion int background_color int second_background_color int third_background_color int fourth_background_color int intensity int rotation string emoticon
 * @return WallPaperSettings
 */

final class WallPaperSettings extends Instance {
	public function request(? true $blur = null,? true $motion = null,? int $background_color = null,? int $second_background_color = null,? int $third_background_color = null,? int $fourth_background_color = null,? int $intensity = null,? int $rotation = null,? string $emoticon = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x372efcd0);
		$flags = 0;
		$flags |= is_null($blur) ? 0 : (1 << 1);
		$flags |= is_null($motion) ? 0 : (1 << 2);
		$flags |= is_null($background_color) ? 0 : (1 << 0);
		$flags |= is_null($second_background_color) ? 0 : (1 << 4);
		$flags |= is_null($third_background_color) ? 0 : (1 << 5);
		$flags |= is_null($fourth_background_color) ? 0 : (1 << 6);
		$flags |= is_null($intensity) ? 0 : (1 << 3);
		$flags |= is_null($rotation) ? 0 : (1 << 4);
		$flags |= is_null($emoticon) ? 0 : (1 << 7);
		$writer->writeInt($flags);
		if(is_null($background_color) === false):
			$writer->writeInt($background_color);
		endif;
		if(is_null($second_background_color) === false):
			$writer->writeInt($second_background_color);
		endif;
		if(is_null($third_background_color) === false):
			$writer->writeInt($third_background_color);
		endif;
		if(is_null($fourth_background_color) === false):
			$writer->writeInt($fourth_background_color);
		endif;
		if(is_null($intensity) === false):
			$writer->writeInt($intensity);
		endif;
		if(is_null($rotation) === false):
			$writer->writeInt($rotation);
		endif;
		if(is_null($emoticon) === false):
			$writer->tgwriteBytes($emoticon);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['blur'] = true;
		else:
			$result['blur'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['motion'] = true;
		else:
			$result['motion'] = false;
		endif;
		if($flags & (1 << 0)):
			$result['background_color'] = $reader->readInt();
		else:
			$result['background_color'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['second_background_color'] = $reader->readInt();
		else:
			$result['second_background_color'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['third_background_color'] = $reader->readInt();
		else:
			$result['third_background_color'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['fourth_background_color'] = $reader->readInt();
		else:
			$result['fourth_background_color'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['intensity'] = $reader->readInt();
		else:
			$result['intensity'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['rotation'] = $reader->readInt();
		else:
			$result['rotation'] = null;
		endif;
		if($flags & (1 << 7)):
			$result['emoticon'] = $reader->tgreadBytes();
		else:
			$result['emoticon'] = null;
		endif;
		return new self($result);
	}
}

?>