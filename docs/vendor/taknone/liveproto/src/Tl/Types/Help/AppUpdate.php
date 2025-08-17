<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id string version string text Vector<MessageEntity> entities true can_not_skip document document string url document sticker
 * @return help.AppUpdate
 */

final class AppUpdate extends Instance {
	public function request(int $id,string $version,string $text,array $entities,? true $can_not_skip = null,? object $document = null,? string $url = null,? object $sticker = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xccbbce30);
		$flags = 0;
		$flags |= is_null($can_not_skip) ? 0 : (1 << 0);
		$flags |= is_null($document) ? 0 : (1 << 1);
		$flags |= is_null($url) ? 0 : (1 << 2);
		$flags |= is_null($sticker) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->writeInt($id);
		$writer->tgwriteBytes($version);
		$writer->tgwriteBytes($text);
		$writer->tgwriteVector($entities,'MessageEntity');
		if(is_null($document) === false):
			$writer->write($document->read());
		endif;
		if(is_null($url) === false):
			$writer->tgwriteBytes($url);
		endif;
		if(is_null($sticker) === false):
			$writer->write($sticker->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['can_not_skip'] = true;
		else:
			$result['can_not_skip'] = false;
		endif;
		$result['id'] = $reader->readInt();
		$result['version'] = $reader->tgreadBytes();
		$result['text'] = $reader->tgreadBytes();
		$result['entities'] = $reader->tgreadVector('MessageEntity');
		if($flags & (1 << 1)):
			$result['document'] = $reader->tgreadObject();
		else:
			$result['document'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['url'] = $reader->tgreadBytes();
		else:
			$result['url'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['sticker'] = $reader->tgreadObject();
		else:
			$result['sticker'] = null;
		endif;
		return new self($result);
	}
}

?>