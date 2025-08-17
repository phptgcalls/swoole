<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer true wallpaper_overridden wallpaper wallpaper
 * @return Update
 */

final class UpdatePeerWallpaper extends Instance {
	public function request(object $peer,? true $wallpaper_overridden = null,? object $wallpaper = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xae3f101d);
		$flags = 0;
		$flags |= is_null($wallpaper_overridden) ? 0 : (1 << 1);
		$flags |= is_null($wallpaper) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($wallpaper) === false):
			$writer->write($wallpaper->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['wallpaper_overridden'] = true;
		else:
			$result['wallpaper_overridden'] = false;
		endif;
		$result['peer'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['wallpaper'] = $reader->tgreadObject();
		else:
			$result['wallpaper'] = null;
		endif;
		return new self($result);
	}
}

?>