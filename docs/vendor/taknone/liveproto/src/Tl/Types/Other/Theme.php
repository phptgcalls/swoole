<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash string slug string title true creator true default true for_chat document document Vector<ThemeSettings> settings string emoticon int installs_count
 * @return Theme
 */

final class Theme extends Instance {
	public function request(int $id,int $access_hash,string $slug,string $title,? true $creator = null,? true $default = null,? true $for_chat = null,? object $document = null,? array $settings = null,? string $emoticon = null,? int $installs_count = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa00e67d6);
		$flags = 0;
		$flags |= is_null($creator) ? 0 : (1 << 0);
		$flags |= is_null($default) ? 0 : (1 << 1);
		$flags |= is_null($for_chat) ? 0 : (1 << 5);
		$flags |= is_null($document) ? 0 : (1 << 2);
		$flags |= is_null($settings) ? 0 : (1 << 3);
		$flags |= is_null($emoticon) ? 0 : (1 << 6);
		$flags |= is_null($installs_count) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		$writer->tgwriteBytes($slug);
		$writer->tgwriteBytes($title);
		if(is_null($document) === false):
			$writer->write($document->read());
		endif;
		if(is_null($settings) === false):
			$writer->tgwriteVector($settings,'ThemeSettings');
		endif;
		if(is_null($emoticon) === false):
			$writer->tgwriteBytes($emoticon);
		endif;
		if(is_null($installs_count) === false):
			$writer->writeInt($installs_count);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
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
		if($flags & (1 << 5)):
			$result['for_chat'] = true;
		else:
			$result['for_chat'] = false;
		endif;
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		$result['slug'] = $reader->tgreadBytes();
		$result['title'] = $reader->tgreadBytes();
		if($flags & (1 << 2)):
			$result['document'] = $reader->tgreadObject();
		else:
			$result['document'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['settings'] = $reader->tgreadVector('ThemeSettings');
		else:
			$result['settings'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['emoticon'] = $reader->tgreadBytes();
		else:
			$result['emoticon'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['installs_count'] = $reader->readInt();
		else:
			$result['installs_count'] = null;
		endif;
		return new self($result);
	}
}

?>