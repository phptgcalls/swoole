<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<Document> documents themesettings settings
 * @return WebPageAttribute
 */

final class WebPageAttributeTheme extends Instance {
	public function request(? array $documents = null,? object $settings = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x54b56617);
		$flags = 0;
		$flags |= is_null($documents) ? 0 : (1 << 0);
		$flags |= is_null($settings) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($documents) === false):
			$writer->tgwriteVector($documents,'Document');
		endif;
		if(is_null($settings) === false):
			$writer->write($settings->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['documents'] = $reader->tgreadVector('Document');
		else:
			$result['documents'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['settings'] = $reader->tgreadObject();
		else:
			$result['settings'] = null;
		endif;
		return new self($result);
	}
}

?>