<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id true default true dark wallpapersettings settings
 * @return WallPaper
 */

final class WallPaperNoFile extends Instance {
	public function request(int $id,? true $default = null,? true $dark = null,? object $settings = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe0804116);
		$writer->writeLong($id);
		$flags = 0;
		$flags |= is_null($default) ? 0 : (1 << 1);
		$flags |= is_null($dark) ? 0 : (1 << 4);
		$flags |= is_null($settings) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($settings) === false):
			$writer->write($settings->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['default'] = true;
		else:
			$result['default'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['dark'] = true;
		else:
			$result['dark'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['settings'] = $reader->tgreadObject();
		else:
			$result['settings'] = null;
		endif;
		return new self($result);
	}
}

?>