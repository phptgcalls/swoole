<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash string slug document document true creator true default true pattern true dark wallpapersettings settings
 * @return WallPaper
 */

final class WallPaper extends Instance {
	public function request(int $id,int $access_hash,string $slug,object $document,? true $creator = null,? true $default = null,? true $pattern = null,? true $dark = null,? object $settings = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa437c3ed);
		$writer->writeLong($id);
		$flags = 0;
		$flags |= is_null($creator) ? 0 : (1 << 0);
		$flags |= is_null($default) ? 0 : (1 << 1);
		$flags |= is_null($pattern) ? 0 : (1 << 3);
		$flags |= is_null($dark) ? 0 : (1 << 4);
		$flags |= is_null($settings) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeLong($access_hash);
		$writer->tgwriteBytes($slug);
		$writer->write($document->read());
		if(is_null($settings) === false):
			$writer->write($settings->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['creator'] = true;
		else:
			$result['creator'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['default'] = true;
		else:
			$result['default'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['pattern'] = true;
		else:
			$result['pattern'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['dark'] = true;
		else:
			$result['dark'] = false;
		endif;
		$result['access_hash'] = $reader->readLong();
		$result['slug'] = $reader->tgreadBytes();
		$result['document'] = $reader->tgreadObject();
		if($flags & (1 << 2)):
			$result['settings'] = $reader->tgreadObject();
		else:
			$result['settings'] = null;
		endif;
		return new self($result);
	}
}

?>