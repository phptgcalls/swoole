<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true small inputdocument document string title string performer
 * @return InputWebFileLocation
 */

final class InputWebFileAudioAlbumThumbLocation extends Instance {
	public function request(? true $small = null,? object $document = null,? string $title = null,? string $performer = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf46fe924);
		$flags = 0;
		$flags |= is_null($small) ? 0 : (1 << 2);
		$flags |= is_null($document) ? 0 : (1 << 0);
		$flags |= is_null($title) ? 0 : (1 << 1);
		$flags |= is_null($performer) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($document) === false):
			$writer->write($document->read());
		endif;
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($performer) === false):
			$writer->tgwriteBytes($performer);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 2)):
			$result['small'] = true;
		else:
			$result['small'] = false;
		endif;
		if($flags & (1 << 0)):
			$result['document'] = $reader->tgreadObject();
		else:
			$result['document'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['title'] = $reader->tgreadBytes();
		else:
			$result['title'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['performer'] = $reader->tgreadBytes();
		else:
			$result['performer'] = null;
		endif;
		return new self($result);
	}
}

?>