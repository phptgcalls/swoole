<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string link string message int views Vector<MessageEntity> entities string title
 * @return BusinessChatLink
 */

final class BusinessChatLink extends Instance {
	public function request(string $link,string $message,int $views,? array $entities = null,? string $title = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb4ae666f);
		$flags = 0;
		$flags |= is_null($entities) ? 0 : (1 << 0);
		$flags |= is_null($title) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($link);
		$writer->tgwriteBytes($message);
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
		endif;
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		$writer->writeInt($views);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['link'] = $reader->tgreadBytes();
		$result['message'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['entities'] = $reader->tgreadVector('MessageEntity');
		else:
			$result['entities'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['title'] = $reader->tgreadBytes();
		else:
			$result['title'] = null;
		endif;
		$result['views'] = $reader->readInt();
		return new self($result);
	}
}

?>