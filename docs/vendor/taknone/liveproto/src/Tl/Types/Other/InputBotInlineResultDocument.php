<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string id string type inputdocument document inputbotinlinemessage send_message string title string description
 * @return InputBotInlineResult
 */

final class InputBotInlineResultDocument extends Instance {
	public function request(string $id,string $type,object $document,object $send_message,? string $title = null,? string $description = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfff8fdc4);
		$flags = 0;
		$flags |= is_null($title) ? 0 : (1 << 1);
		$flags |= is_null($description) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($id);
		$writer->tgwriteBytes($type);
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($description) === false):
			$writer->tgwriteBytes($description);
		endif;
		$writer->write($document->read());
		$writer->write($send_message->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['id'] = $reader->tgreadBytes();
		$result['type'] = $reader->tgreadBytes();
		if($flags & (1 << 1)):
			$result['title'] = $reader->tgreadBytes();
		else:
			$result['title'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['description'] = $reader->tgreadBytes();
		else:
			$result['description'] = null;
		endif;
		$result['document'] = $reader->tgreadObject();
		$result['send_message'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>