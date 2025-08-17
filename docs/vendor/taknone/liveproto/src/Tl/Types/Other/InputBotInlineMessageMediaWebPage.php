<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string message string url true invert_media true force_large_media true force_small_media true optional Vector<MessageEntity> entities replymarkup reply_markup
 * @return InputBotInlineMessage
 */

final class InputBotInlineMessageMediaWebPage extends Instance {
	public function request(string $message,string $url,? true $invert_media = null,? true $force_large_media = null,? true $force_small_media = null,? true $optional = null,? array $entities = null,? object $reply_markup = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbddcc510);
		$flags = 0;
		$flags |= is_null($invert_media) ? 0 : (1 << 3);
		$flags |= is_null($force_large_media) ? 0 : (1 << 4);
		$flags |= is_null($force_small_media) ? 0 : (1 << 5);
		$flags |= is_null($optional) ? 0 : (1 << 6);
		$flags |= is_null($entities) ? 0 : (1 << 1);
		$flags |= is_null($reply_markup) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($message);
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
		endif;
		$writer->tgwriteBytes($url);
		if(is_null($reply_markup) === false):
			$writer->write($reply_markup->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 3)):
			$result['invert_media'] = true;
		else:
			$result['invert_media'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['force_large_media'] = true;
		else:
			$result['force_large_media'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['force_small_media'] = true;
		else:
			$result['force_small_media'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['optional'] = true;
		else:
			$result['optional'] = false;
		endif;
		$result['message'] = $reader->tgreadBytes();
		if($flags & (1 << 1)):
			$result['entities'] = $reader->tgreadVector('MessageEntity');
		else:
			$result['entities'] = null;
		endif;
		$result['url'] = $reader->tgreadBytes();
		if($flags & (1 << 2)):
			$result['reply_markup'] = $reader->tgreadObject();
		else:
			$result['reply_markup'] = null;
		endif;
		return new self($result);
	}
}

?>