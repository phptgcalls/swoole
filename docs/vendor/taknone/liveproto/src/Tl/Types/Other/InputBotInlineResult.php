<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string id string type inputbotinlinemessage send_message string title string description string url inputwebdocument thumb inputwebdocument content
 * @return InputBotInlineResult
 */

final class InputBotInlineResult extends Instance {
	public function request(string $id,string $type,object $send_message,? string $title = null,? string $description = null,? string $url = null,? object $thumb = null,? object $content = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x88bf9319);
		$flags = 0;
		$flags |= is_null($title) ? 0 : (1 << 1);
		$flags |= is_null($description) ? 0 : (1 << 2);
		$flags |= is_null($url) ? 0 : (1 << 3);
		$flags |= is_null($thumb) ? 0 : (1 << 4);
		$flags |= is_null($content) ? 0 : (1 << 5);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($id);
		$writer->tgwriteBytes($type);
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($description) === false):
			$writer->tgwriteBytes($description);
		endif;
		if(is_null($url) === false):
			$writer->tgwriteBytes($url);
		endif;
		if(is_null($thumb) === false):
			$writer->write($thumb->read());
		endif;
		if(is_null($content) === false):
			$writer->write($content->read());
		endif;
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
		if($flags & (1 << 3)):
			$result['url'] = $reader->tgreadBytes();
		else:
			$result['url'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['thumb'] = $reader->tgreadObject();
		else:
			$result['thumb'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['content'] = $reader->tgreadObject();
		else:
			$result['content'] = null;
		endif;
		$result['send_message'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>