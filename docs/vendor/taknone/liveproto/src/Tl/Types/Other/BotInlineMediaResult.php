<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string id string type botinlinemessage send_message photo photo document document string title string description
 * @return BotInlineResult
 */

final class BotInlineMediaResult extends Instance {
	public function request(string $id,string $type,object $send_message,? object $photo = null,? object $document = null,? string $title = null,? string $description = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x17db940b);
		$flags = 0;
		$flags |= is_null($photo) ? 0 : (1 << 0);
		$flags |= is_null($document) ? 0 : (1 << 1);
		$flags |= is_null($title) ? 0 : (1 << 2);
		$flags |= is_null($description) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($id);
		$writer->tgwriteBytes($type);
		if(is_null($photo) === false):
			$writer->write($photo->read());
		endif;
		if(is_null($document) === false):
			$writer->write($document->read());
		endif;
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($description) === false):
			$writer->tgwriteBytes($description);
		endif;
		$writer->write($send_message->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['id'] = $reader->tgreadBytes();
		$result['type'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['photo'] = $reader->tgreadObject();
		else:
			$result['photo'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['document'] = $reader->tgreadObject();
		else:
			$result['document'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['title'] = $reader->tgreadBytes();
		else:
			$result['title'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['description'] = $reader->tgreadBytes();
		else:
			$result['description'] = null;
		endif;
		$result['send_message'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>